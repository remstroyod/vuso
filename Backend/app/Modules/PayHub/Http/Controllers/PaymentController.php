<?php
namespace Backend\Modules\PayHub\Http\Controllers;

use Frontend\Models\Pages;
use Illuminate\Http\Request;
use Frontend\Models\Profile\User;
use Frontend\Traits\SendSMSTrait;
use Illuminate\Http\JsonResponse;
use Backend\Enums\OrderStatusEnum;
use Backend\Models\Ecommerce\Order;
use Illuminate\Support\Facades\Hash;
use Backend\Http\Controllers\Controller;
use Backend\Modules\PayHub\Models\PayHubLog;
use Backend\Modules\PayHub\Services\PayService;
use Backend\Modules\PayHub\Services\IPayService;
use Backend\Modules\PayHub\Services\EasyPayService;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Http\Controllers\Ecommerce\OrdersController;
use Backend\Modules\PayHub\Models\BaseModels\PaymentData;
use Backend\Modules\PayHub\Enums\PayHubPaymentStatusEnum;
use Frontend\Http\Requests\Payment\PaymentProcessRequest;
use Backend\Modules\PayHub\Models\BaseModels\RecurrentPayment;
use Frontend\Http\Requests\Payment\PaymentCheckContractRequest;
use Backend\Modules\PayHub\Models\BaseModels\PaymentSystemContract;

use Backend\Modules\PayHub\Http\Requests\Payment\PayToCard;
use Backend\Modules\PayHub\Http\Requests\Payment\PaymentState;
use Backend\Modules\PayHub\Http\Requests\Payment\PayRecurrent;
use Backend\Modules\PayHub\Http\Requests\Payment\CancelPayment;
use Backend\Modules\PayHub\Http\Requests\Payment\GeneratePaymentLink;

use Egorovwebservices\Payhub\Interfaces\Contract;
use Egorovwebservices\Payhub\Enums\PaySystemsEnum;
use Egorovwebservices\Payhub\Traits\Log as PayHubLogTrait;
use Egorovwebservices\Response\Response as ResponseService;

class PaymentController extends Controller
{
    use PayHubLogTrait;
    use SendSMSTrait;

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

    /**
     * @param PaymentCheckContractRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkContract(PaymentCheckContractRequest $request)
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

        if( $request->is('api/*') )
        {

            $request->merge(['sms_code' => $user->sms_code]);

            return $this->generateUrlPayment($request, $user, $contract);

        }else{

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
    public function process(PaymentProcessRequest $request, User $user, EdocumentUser $contract)
    {
        return $this->generateUrlPayment($request, $user, $contract);
    }

    /**
     * @param $request
     * @param $user
     * @param $contract
     * @return \Illuminate\Http\JsonResponse|void
     */
    protected function generateUrlPayment($request, $user, $contract)
    {
        return response()->json(['status' => false]);

        if( !$user || !$contract ) {
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

        if( $contract->product->payhub->key === PaySystemsEnum::SYSTEM_EASYPAY ) {
            $pay = new EasyPayService($contract);
            $response = $pay->process();
        }

        if( $contract->product->payhub->key === PaySystemsEnum::SYSTEM_IPAY ) {
            $pay = new IPayService($contract);
            $response = $pay->process();
        }

        if( $response->isClientError() ) {
            return response()->json($response->getOriginalContent(), 403);
        }

        return response()->json($response->getOriginalContent(), 200);

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

    /**
     * @param $contract
     * @param $status
     * @return mixed
     */
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
        ]);
        $order->history()->create([
            'status' => $status
        ]);

        return $order;

    }





    public function linkGenerate(GeneratePaymentLink $request): JsonResponse
    {
        $responseService = new ResponseService();

        try {
            $request_data = $request->validated();

            $User = new \Backend\Modules\PayHub\Models\BaseModels\User();
            $User->setPhone($request_data['client_data']['phone']);

            $paymentData = (new PaymentData())
                ->unserialize(json_encode($request_data['payment_data']));
            $paymentData->phDbg(__LINE__, __FILE__, $paymentData);

            $PaymentContract = new PaymentSystemContract($User, $paymentData);
            $PaymentContract->setTransactionHash($request_data['hash']);

            return (new PayService($PaymentContract))->getServiceByContract()->paymentLinkGenerate();
        } catch (\Throwable $exception) {
            $responseService->addError($exception->getMessage());
            $this->phExc($exception, __LINE__, __FILE__);
        }

        return response()->json($responseService);
    }

    public function cancelPayment(CancelPayment $request): JsonResponse
    {
        $request_data = $request->validated();

        $Response = (new AcquiringResponse())->getByHash($request_data['hash']);
        if(! $Response) return response()->json((new ResponseService())->addError('Incorrect transaction_hash'));

        $User = new \Backend\Modules\PayHub\Models\BaseModels\User();
        $paymentData = new PaymentData(array_merge($request_data, ['payment_system' => $Response->system_name]));
        $paymentData->setPaySystemId($Response->system_id);

        $paymentContract = new PaymentSystemContract($User, $paymentData);
        $paymentContract->setTransactionHash($Response->hash);

        return ((new PayService($paymentContract))->getServiceByContract())->cancelPayment($Response);
    }

    public function paymentState(PaymentState $request): JsonResponse
    {
        $request_data = $request->validated();

        $Response = (new AcquiringResponse())->getByHash($request_data['hash']);
        if(! $Response) return response()->json((new ResponseService())->addError('Incorrect transaction hash'));

        $User = new \Backend\Modules\PayHub\Models\BaseModels\User();

        $paymentData = new PaymentData(array_merge($request_data, ['payment_system' => $Response->system_name]));
        $paymentData->setPaySystemId($Response->system_id);

        $paymentContract = new PaymentSystemContract($User, $paymentData);
        $paymentContract->setTransactionHash($Response->hash);

        return ((new PayService($paymentContract))->getServiceByContract())->orderState($Response);
    }

    public function payRecurrent(PayRecurrent $request): JsonResponse
    {
        $response = new ResponseService();

        try {
            $payment = $request->validated()['payment'];

            $payment = (new RecurrentPayment())->unserialize(json_encode($payment));
            return (new PayService($payment))->getServiceByContract()->payRecurrentPayment();
        } catch (\Throwable $exception) {
            $response->addError($exception->getMessage());
            $this->phExc($exception, __LINE__, __FILE__);
        }

        return response()->json($response);
    }

    public function payToCard(PayToCard $request): JsonResponse
    {
        $response = new ResponseService();

        try {
            $request = $request->validated()['contract'];

            $contract = new PaymentSystemContract();
            $contract = $contract->unserialize(json_encode($request));

            return (new PayService($contract))->getServiceByContract()->payToCard();
        } catch (\Throwable $exception) {
            $response->addError($exception->getMessage());
            $this->phExc($exception, __LINE__, __FILE__);
        }

        return response()->json($response);
    }
}
