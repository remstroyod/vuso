<?php

namespace Frontend\Http\Controllers\Profile;

use Backend\Enums\StreetTypeEnum;
use Backend\Http\Resources\API\v1\Dictionaries\CountryResource;
use Backend\Http\Resources\API\v1\Dictionaries\DictionaryLocalizationResource;
use Backend\Http\Resources\API\v1\Dictionaries\DictionaryResource;
use Backend\Models\Dictionaries\Autoria\Mark;
use Backend\Models\Dictionaries\Autoria\Transmissions;
use Backend\Models\Dictionaries\Autoria\TsType;
use Backend\Models\Dictionaries\Country;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Backend\Modules\PayHub\Models\BaseModels\PaymentData;
use Backend\Modules\PayHub\Models\BaseModels\PaymentSystemContract;
use Backend\Modules\PayHub\Services\PayService;
use Carbon\Carbon;
use Frontend\Enums\ProvidersEnum;
use Frontend\Http\Controllers\Controller;
use Frontend\Http\Handlers\Profile\StorePersonHandler;
use Frontend\Http\Requests\Profile\CheckSmsRequest;
use Frontend\Http\Requests\Profile\PersonRequest;
use Frontend\Http\Requests\Profile\SaveCodeRequest;
use Frontend\Models\Pages;
use Frontend\Models\Profile\User;
use Frontend\Models\Sales\Sales;
use Frontend\Services\ConnectionOneCService;
use Frontend\Services\User\UserPasswordService;
use Frontend\Traits\SendSMSTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use SendSMSTrait;

    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {
        $model = $pages->findOrFail('profile');
        $user = auth()->user();
        $importOneC = new ConnectionOneCService();
        $importOneC->createInsuranceDocs($user->detail);

        return view('profile.index', [
            'page' => $model,
            'sales' => Sales::getLast(1)->first(),
            'faqs' => $model->faqs,
            'insuranceDocs' => $user->eDocumentUser,
            'blocks' => $model->blocks,
            'user' => $user,
        ]);
    }

    public function downloadPdf(Request $request)
    {
        $document = EdocumentUser::find($request->id);

        $response = '';
        if ($Response = (new AcquiringResponse())->getByHash($document->transaction_hash)) {
            if($Response->getReceipt()) {
                $paymentData = new PaymentData();
                $paymentData->setPaySystemId($Response->system_id);

                $contract = new PaymentSystemContract(new \Backend\Modules\PayHub\Models\BaseModels\User(), $paymentData);
                $response = (new PayService($contract))->getServiceByContract()->getReceipt($Response);
            }
        }

        $file = Storage::disk('google')->get($document->path);

        if ($file) {
            return response()->json(
                [
                    'status' => true,
                    'receipt' => $response,
                    'data' => base64_encode($file)
                ], 200);
//            return (new Response(base64_encode($file), 200))->header('Content-Type', $document->mimetype);
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pages $pages)
    {

        $model = $pages->findOrFail('profile');
        $user = auth()->user();
        $result = Mark::all();
        $years = range(Carbon::now()->year, 1990);
        $transmissions = Transmissions::all();
        $tsTypes = TsType::all();
        $country = Country::where('is_valid', 1)->where('is_disabled', 0)->where('id', 1)->first();

        return view('profile.index', [
            'persons' => $user->objInsurancePersons,
            'cars' => $user->objInsuranceCars,
            'buildings' => $user->objInsuranceBuildings,
            'page' => $model,
            'user' => $user,
            'userDetail' => $user->detail,
            'providers' => ProvidersEnum::toArray(),
            'type_street' => StreetTypeEnum::$name,
            'sales' => Sales::getLast(1)->first(),
            'faqs' => $model->faqs,
            'marks' => DictionaryResource::collection($result),
            'years' => $years,
            'transmissions' => DictionaryResource::collection($transmissions),
            'tsTypes' => DictionaryLocalizationResource::collection($tsTypes),
            'country' => new CountryResource($country),
//            'cars' => $user->cars->first(),
            'blocks' => $model->blocks,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, StorePersonHandler $handler)
    {

        $user = auth()->user();

        if ($user = $handler->process($request, $user)) :

            return response()->json([
                'status' => 'success',
                'message' => __( 'Данные успешно сохранены' ),
                'html' => view('profile.card.card-person', [
                    'user' => $user,
                    'userDetail' => $user->detail,
                    'type_street' => StreetTypeEnum::$name,
                ])->render(),
            ]);

        endif;

        return response()->json([
            'status' => 'error',
            'message' => $user
        ], 400);

    }

    public function checkLoginData(CheckSmsRequest $request)
    {
        $needConfirmCode = false;

        if ($request->input('phone')) {
            $message = $this->send($request->user(), $request->input('phone'));

            if ($message) {
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'phone' => [
                            $message,
                        ]
                    ],
                ], 401);
            } else {
                $needConfirmCode = true;
            }
        }

        if ($request->input('password')) {
            $service = new UserPasswordService($request->user());

            if ($request->input('newPassword')) {
                $service->savePassword($request->input('newPassword'));
            } else {
                $service->savePassword($request->input('password'));
            }
        }

        return response([
            'status' => 'success',
            'redirect' => route('profile.edit'),
            'needConfirmCode' => $needConfirmCode
        ]);
    }

    public function saveLoginData(SaveCodeRequest $request)
    {
        $service = new UserPasswordService($request->user());
        $service->savePhone($request->input('phone'));
        //TODO: set request to bitrix24
        return response([
            'status' => 'success',
            'redirect' => route('profile.edit')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function send(User $user, string $phone): ?string
    {
        if (!empty($phone)) {
            $response = $this->api($phone);

            if ($response->ok()) {
                $user->sms_code = $response->code;
                $user->save();

                return null;
            } else {
                return $response->object()->requestError->serviceException->text;
            }
        }

        return __('В профиле не привязан номер телефона');

    }
}
