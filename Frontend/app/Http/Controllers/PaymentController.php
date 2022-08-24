<?php
namespace Frontend\Http\Controllers;

use Backend\Models\Catalog\Product;
use Backend\Models\Log;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Backend\Modules\PayHub\Models\BaseModels\PaymentData;
use Egorovwebservices\Payhub\Interfaces\Contract;
use Frontend\Models\Pages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Backend\Integrations\Payhub;
use Frontend\Traits\SendSMSTrait;
use Frontend\Models\Profile\User;
use Backend\Enums\OrderStatusEnum;
use Backend\Models\Ecommerce\Order;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Frontend\Events\OrderStatusChanged;
use Backend\Modules\PayHub\Models\PayHubLog;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Egorovwebservices\Payhub\Enums\StatusEnum;
use Backend\Modules\PayHub\Services\PayService;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Http\Controllers\Ecommerce\OrdersController;
use Frontend\Http\Requests\Payment\PaymentProcessRequest;
use Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum;
use Frontend\Http\Requests\Payment\PaymentCheckContractRequest;
use Frontend\Jobs\OrderStatusJob;
use Frontend\Notifications\UserContractNotification;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    use SendSMSTrait;

    protected $urlApi = 'https://ipa.vuso.ua/api/v1';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

//        Auth::loginUsingId(1);
//        $valid = Promocodes::apply('WZ38-52KN');

        $model = $pages->findOrFail('payment');

        return view('pages.payment.index', [
            'page'          => $model,
            'blocks'        => $model->blocks,
        ]);

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function success(Request $request, EdocumentUser $contract, Pages $pages, PayHubLog $log)
    {

        $contract->update([
            'payment_status' => PayHubPaymentStatusEnum::paid,
            'transaction_id' => $request->input('transactionId'),
        ]);

        $log->create([
            'system_id' => $contract->product->payhub_id,
            'document_id' => $contract->id,
            'status' => PayHubPaymentStatusEnum::paid,
            'request' => $request->all(),
        ]);

        $order = $this->UpdateOrCreateOrder($contract, OrderStatusEnum::paid);

        return redirect()->route('payment.success.render', ['status' => 'success', 'contract' => $contract->id, 'order' => $order->order_id]);

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function error(Request $request, EdocumentUser $contract, Pages $pages, PayHubLog $log)
    {

        $contract->update([
            'payment_status' => PayHubPaymentStatusEnum::errorpaid
        ]);

        $log->create([
            'system_id' => $contract->product->payhub_id,
            'document_id' => $contract->id,
            'status' => PayHubPaymentStatusEnum::errorpaid,
            'request' => $request->all(),
        ]);

        $order = $this->UpdateOrCreateOrder($contract, OrderStatusEnum::pending);

        return redirect()->route('payment.error.render', ['status' => 'error', 'contract' => $contract->id, 'order' => $order->order_id]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function successRender(Request $request, Pages $pages)
    {

        $contract = Order::where('order_id', $request->order)->where('document_id', $request->contract)->first();

        //TO DO DELETE

        if( $contract )
        {
            $contract = $contract->document;
        }else{
            abort(404);
        }

        $page = $pages->findOrFail('payment');

        return view('pages.payment.success', [
            'page'          => $page,
            'contract'      => $contract,
        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function errorRender(Request $request, Pages $pages)
    {

        $contract = Order::where('order_id', $request->order)->where('document_id', $request->contract)->first();

        //TO DO DELETE

        if( !$contract ) abort(404);

        $page = $pages->findOrFail('payment');

        return view('pages.payment.error', [
            'page' => $page,
        ]);

    }

    public function checkContract(PaymentCheckContractRequest $request): JsonResponse
    {
        $contract = EdocumentUser::where('dogovor_id', $request->input('dogovor_id'))->first();

        $user = $contract->user;
        $product = $contract->product;

        if( !$user )
        {

            return response()->json([
                'errors' => [
                    'dogovor_id' => [
                        __( 'Пользователь с таким договором не найден' )
                    ]
                ]
            ], 422);

        }

        if( $contract->payment_status == PayHubPaymentStatusEnum::paid )
        {

            return response()->json([
                'errors' => [
                    'dogovor_id' => [
                        __( 'Этот договор уже оплачен' )
                    ]
                ]
            ], 422);

        }

        if( $request->is('api/*') ) {
            $request->merge(['sms_code' => $user->sms_code]);
            return $this->generateUrlPayment($request, $user, $contract);
        } else {
            $sms = $this->send($user);

            if( $sms->isClientError() )
            {
                return response()->json([
                    'status' => false,
                    'message' => $sms->getOriginalContent()
                ], 403);
            }

            return response()->json([
                'status' => true,
                'message' => view('pages.payment.steps.step-2', ['user' => $user, 'product' => $product, 'contract' => $contract])->render()
            ], 200);

        }

    }

    /**
     * @param PaymentProcessRequest $request
     * @param EdocumentUser $contract
     * @return void
     */
    public function orderCancelProcess(PaymentProcessRequest $request, User $user, EdocumentUser $contract)
    {

        if( !$user || !$contract )
        {
            return response()->json([
                'errors' => [
                    'user' => [
                        __( 'Данные пользователя не найдены' )
                    ]
                ]
            ], 422);
        }

        if( $request->input('sms_code') != $user->sms_code )
        {

            return response()->json([
                'errors' => [
                    'sms_code' => [
                        __( 'Неверный код из SMS' )
                    ]
                ]
            ], 422);

        }

        return $this->orderCancel($request, $user, $contract);

    }

    protected function generateUrlPayment($request, $user, EdocumentUser $contract): JsonResponse
    {
        if( !$user || !$contract ) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'user' => [
                        __( 'Данные пользователя не найдены' )
                    ]
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if( $request->input('sms_code') != $user->sms_code ) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'user' => [
                        __( 'Неверный код из SMS' )
                    ]
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $payment_data = [
            'error_redirect_url' => env('APP_URL') . '/' . $request->errorUrl . '&acquiring=' . $contract->product->payhub->key,
            'success_redirect_url' => env('APP_URL') . '/' . $request->successUrl . '&acquiring=' . $contract->product->payhub->key,
            'payment_system' => $contract->product->payhub->key,
            'is_recurrent' => $request->is_recurrent || false,
        ];

        $paymentData = new PaymentData($payment_data);
        $contract->setPaymentData($paymentData);

        Log::debug($request->all(), __LINE__, __FILE__);
        return (new PayService($contract))->getServiceByContract()->paymentLinkGenerate();
    }

    public function process(PaymentProcessRequest $request, User $user, EdocumentUser $contract): JsonResponse
    {
        return $this->generateUrlPayment($request, $user, $contract);
    }

        /**
     * @param $request
     * @param $user
     * @param Contract $contract
     * @return \Illuminate\Http\JsonResponse|void
     */
    protected function orderCancel($request, $user, Contract $contract)
    {
        $Response = (new AcquiringResponse())->getByTransactionId($contract->getTransactionId());
        return (new PayService($contract))->getServiceByContract()->cancelPayment($Response);
    }

    public function orderStatus(Contract $contract)
    {

        OrderStatusJob::dispatch($contract);

        return response()->json([
            'status' => true,
            'data' => [
                'message' => [
                    __( 'Запрос в обработке' )
                ]
            ]
        ]);
    }

    /**
     * @param $contract
     * @param $status
     * @return mixed
     */

    public function getReceipt(EdocumentUser $contract)
    {
        $response = $contract->getPayHubService()->getReceipt($contract->getTransactionHash());

        return response()->json([
            'status' => true,
            'data' => [
                $response->toArray()
            ]
        ]);
    }

    public function orderContractShare(EdocumentUser $contract){
        
        $contract = EdocumentUser::findOrFail($contract->id);

        $user = $contract->user;

        if(empty($user->email)){
            return response()->json([
                'status' => false,
                'data' => __('Empty email address')
            ], 422);
        }

        try{

            Notification::route('mail', $user->email)
            ->notify(new UserContractNotification($contract));
        
        } catch(\Exception $e){

            return response([
                'message' => $e->getMessage(),
                'status' => false,
            ], 422);
        
        }

        return response([
            'status' => true,
        ], 200);

    }



    private function UpdateOrCreateOrder($contract, $status)
    {

        /**
         * Update Order
         */
        if( $contract->order )
        {

            $contract->order->update([
                'status'            => $status,
                'is_payment'        => (OrderStatusEnum::paid == $status) ? 1 : 0,
            ]);
            $contract->order->history()->create([
                'status' => $status
            ]);

            return Order::find($contract->order->id);
        }

        /**
         * Create Order
         */
        $order = new OrdersController();
        $number = $order->generate();
        $hashing = Hash::make($contract->product->name, [
            'rounds' => 10,
        ]);

        $order = Order::create([
            'order_id'          => $number,
            'user_id'           => $contract->user_id,
            'status'            => $status,
            'total'             => $contract->total,
            'subtotal'          => $contract->total,
            'is_payment'        => (OrderStatusEnum::paid == $status) ? 1 : 0,
        ]);
        $order->products()->create([
            'product_id'        => $contract->product_id,
            'product_id_hash'   => $hashing,
            'name'              => $contract->product->name,
            'price'             => $contract->total,
            'quantity'          => 1,
            'document_id'       => $contract->id,
        ]);
        $order->history()->create([
            'status' => $status
        ]);

        return $order;

    }


    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function buy(Request $request, $id )
    {
        $product = Product::find($id);
        $EdocumentUser = EdocumentUser::where('user_id', $request->input('user'))
            ->where('dogovor_id', $request->input('policy_no'))
            ->firstOrFail();

        $data = [
            'policy_no' => $request->input('policy_no'),
            'otp' => $request->input('otp'),
            'payhub_hash' => $EdocumentUser->transaction_hash
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $product->token,
            'Accept' => 'application/json',
        ])->post($this->urlApi . '/buy-insurance', $data );

        if( $response->ok() )
        {
            $result = $response->json();
            $update = $EdocumentUser->update([
                'dogovor_id' => Arr::get($result, 'data.response.contract.policy_no'),
            ]);
            return response($result, 200);

        }

        return response([
            'message' => $response->clientError(),
            'status' => false,
        ], 422);

    }

}
