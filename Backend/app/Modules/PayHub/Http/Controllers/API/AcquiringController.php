<?php

namespace Backend\Modules\PayHub\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Backend\Modules\PayHub\Services\PayService;
use Backend\Modules\PayHub\Models\BaseModels\User;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Egorovwebservices\Payhub\Traits\Log as PayHubLog;
use Backend\Modules\PayHub\Models\BaseModels\PaymentData;
use Egorovwebservices\Response\Response as ResponseService;
use Backend\Modules\PayHub\Models\BaseModels\PaymentSystemContract;
use Backend\Modules\PayHub\Http\Requests\API\Acquiring\GetResponse;

class AcquiringController extends Controller
{
    use PayHubLog;

    public function getResponse(GetResponse $request): JsonResponse
    {
        $response = new ResponseService();
        $request_data = $request->validated();

        $Response = new AcquiringResponse();
        $Response = $Response->getByHash($request_data[$Response->getHashColumn()]);
        if(! $Response) return response()->json($response->addError('Incorrect transaction_hash'));

        return response()->json($Response->getResponse());
    }

    public function getReceipt(GetResponse $request): JsonResponse
    {
        $response = new ResponseService();
        $request_data = $request->validated();

        $Response = new AcquiringResponse();
        $Response = $Response->getByHash($request_data[$Response->getHashColumn()]);
        if(! $Response) return response()->json($response->addError('Incorrect transaction_hash'));

        if($Response->getReceipt()) {
            $paymentData = new PaymentData(['payment_system' => $Response->system_name]);
            $paymentData->setPaySystemId($Response->system_id);

            $contract = new PaymentSystemContract(new User(), $paymentData);
            $response = (new PayService($contract))->getServiceByContract()->getReceipt($Response);
        }

        return response()->json($response);
    }

    public function getCardData(GetResponse $request): JsonResponse
    {
        $response = new ResponseService();
        $request_data = $request->validated();

        $Response = new AcquiringResponse();
        $Response = $Response->getByHash($request_data[$Response->getHashColumn()]);
        if(! $Response) return response()->json($response->addError('Incorrect transaction_hash'));


        try {
            if($Response->card_data) {
                $response->setOk()
                    ->addData('card_data', $Response->card_data);
            } else $response->addData('card_data', []);
        } catch (\Throwable $exception) {
            $this->phExc($exception, __LINE__, __FILE__);
            $response->addError($exception->getMessage());
        }

        return response()->json($response);
    }
}