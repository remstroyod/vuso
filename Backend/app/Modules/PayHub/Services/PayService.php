<?php

namespace Backend\Modules\PayHub\Services;

use Egorovwebservices\Payhub\Interfaces\CardData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Backend\Modules\PayHub\Models\PayHubSystem;
use Backend\Modules\PayHub\Models\BaseModels\User;
use Backend\Modules\PayHub\Jobs\CompleteNewResponse;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Backend\Modules\PayHub\Models\BaseModels\PaymentData;
use Backend\Modules\PayHub\Models\BaseModels\PaymentSystemContract;

use Egorovwebservices\Payhub\Interfaces\Contract;
use Egorovwebservices\Payhub\Models\Log as PayHubLog;
use Egorovwebservices\Payhub\Interfaces\AcquiringParser;
use Egorovwebservices\Payhub\Interfaces\RecurrentPayment;
use Egorovwebservices\Payhub\Traits\Log as PayHubLogTrait;
use Egorovwebservices\Response\Response as ResponseService;
use Egorovwebservices\Payhub\Models\Response as PayHubResponse;
use Egorovwebservices\Payhub\Interfaces\System as SystemInterface;

class PayService implements AcquiringParser
{
    use PayHubLogTrait;

    private string $system_name = '';

    protected string $webhook_url;

    protected string $class = self::class;
    protected string $system_class = PayHubSystem::class;

    protected SystemInterface $system;

    protected Contract|null $contract = null;
    protected RecurrentPayment|null $recurrentPayment = null;

    public function __construct(RecurrentPayment|Contract $service)
    {
        if($service instanceof RecurrentPayment) {
            $this->recurrentPayment = $service;
            $this->contract = $this->recurrentPayment->getPayHubContract();
        } else $this->contract = $service;

        if(($id = $service->getPaymentData()->getPaySystemId()) > 0) {
            $this->system = (new $this->system_class())->getById($id);
        } else {
            $this->system = $this->contract->getPaySystemData($this->contract->getPaymentData()->isRecurrent());
        }

        if(config('payhub.with_log')) {
            $this->phInf(__LINE__, __FILE__, ['system_id' => $this->system->getId()]);
        }

        $this->webhook_url = $this->getWebhookUrl($this->system->{$this->system->getKeyColumn()}, base64_encode(json_encode([])));
    }

    protected function getWebhookUrl(string $service, string $response): string
    {
        $url = config('payhub.base_url');

        $uri = ltrim(config('payhub.webhook_uri'), '/');
        $uri = '/' . $uri . $service . '/' . $response;

        return $url . $uri;
    }

    protected function getNameSpace(): string
    {
        $class = new \ReflectionClass($this->class);
        return $class->getNamespaceName();
    }

    protected function getJsonResponse(ResponseService $response, int $http_status = Response::HTTP_OK): JsonResponse
    {
        return response()->json($response, $http_status);
    }

    /**
     * Name must be of format "one_world_two_world" (snake)
     *
     * @return PayService
     */
    public function getServiceByContract(): PayService
    {
        if($this->recurrentPayment) $service = $this->recurrentPayment;
        else $service = $this->contract;

        $system = Str::camel($this->system->getSystemKey());
        $class = $this->getNameSpace() . '\\' . Str::ucfirst($system) . 'Service';

        return new $class($service);
    }

    public static function parseResponse(Request $request, string $service, string $response): JsonResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $Log = new PayHubLog(); $Log->system = $service;
        $Log->dbg(__LINE__, __FILE__, $request->all());

        try {
            $paymentData = new PaymentData(['payment_system' => $service]);
            $contract = new PaymentSystemContract(new User(), $paymentData);

            $status = AcquiringResponse::parseAcquiringResponse($contract, $request->all());
            if($request->method() === Request::METHOD_GET) return redirect('/'); // TODO change this
        } catch (\Throwable $exception) {
            $Log = new PayHubLog(); $Log->system = $service;
            $Log->exc($exception,__LINE__, __FILE__, $request->all());

            $status = false;
        }

        return response()->json(['status' => $status]);
    }

    /********************** AcquiringParser Interface ***************/
    public function setStatuses(PayHubResponse $Response, $status = null): void {}
    public function setHashFromAcquiringResponse(array $response) {}
    public function setTransactionIdFromAcquiringResponse(array $response){}
    public function setOrderIdFromAcquiringResponse(array $response) {}
    public function setSystemIdFromAcquiringResponse(array $response) {}
    public function setAmountFromAcquiringResponse(PayHubResponse $Response, array $response): void {}
    public function getCardDataFromAcquiringResponse(array $response): CardData {}
    public function isPaymentResponse(array $response): bool {}
    public function isCardDataResponse(array $response): bool {}
    public function isCancelResponse(array $response): bool {}

    public function initBaseRecurrentPaymentResponse(ResponseService $response): AcquiringResponse {}
    public function initBasePayToCardResponse(ResponseService $response): AcquiringResponse
    {
        $Response = new AcquiringResponse();

        $Response->system_id = $this->system->getId();
        $Response->system_name = $this->system->getSystemKey();

        $Response->transaction_id = 0;
        $Response->hash = $this->contract->getTransactionHash();
        $Response->order_id = $this->contract->getPaymentData()->getOrderId();

        return $Response;
    }
    /*******************************************************************/

    public function parseAcquiringResponse(array $acquiring_data): PayhubResponse
    {
        try {
            $this->setHashFromAcquiringResponse($acquiring_data);
            $this->setTransactionIdFromAcquiringResponse($acquiring_data);
            $this->setOrderIdFromAcquiringResponse($acquiring_data);
            $this->setSystemIdFromAcquiringResponse($acquiring_data);

            $this->system_name = $this->contract->getPaymentData()->getPaySystemKey();

            $hash = $this->contract->getTransactionHash();
            if(! $Response = (new AcquiringResponse())->getByHash($hash)) {
                $Response = new AcquiringResponse();
                $Response->system_id = $this->contract->getPaymentData()->getPaySystemId();
                $Response->order_id = $this->contract->getPaymentData()->getOrderId();
                $Response->transaction_id = $this->contract->getTransactionId();
                $Response->system_name = $this->system_name;
                $Response->hash = $hash;
            }
            $this->setAmountFromAcquiringResponse($Response, $acquiring_data);

            if($this->isPaymentResponse($acquiring_data)) {
                $Response->payment_data = $acquiring_data;
            }

            if($this->isCardDataResponse($acquiring_data)) {
                $Response->card_data = $this->getCardDataFromAcquiringResponse($acquiring_data);
            }

            if($this->isCancelResponse($acquiring_data)) {
                $Response->cancel_data = $acquiring_data;
            }

            return $Response;
        } catch (\Throwable $exception) {
            $this->phExc($exception, __LINE__, __FILE__);
            throw new \Exception($exception->getMessage());
        }
    }

    protected function parsePayRecurrentPaymentResponse(ResponseService $response): ResponseService
    {
        $Response = $this->initBaseRecurrentPaymentResponse($response);

        $Response->hash = $this->recurrentPayment->getTransactionHash();
        $Response->amount = $this->recurrentPayment->getPaymentData()->getAmount();
        $Response->system_id = $this->recurrentPayment->getPaymentData()->getPaySystemId();
        $Response->system_name = $this->recurrentPayment->getPaymentData()->getPaySystemKey();

        $this->setStatuses($Response, $Response->acquiring_status);

        $responseService = (new ResponseService())->setStatus($Response->save());
        if($responseService->isOk()) dispatch(new CompleteNewResponse($Response));
        else $responseService->addError('Payment error');

        return $responseService;
    }

    public function payRecurrentPayment(): JsonResponse
    {
        $cardResponse = $this->recurrentPayment->getPayHubContract()->getPayHubService()
            ->getCardData($this->recurrentPayment->getPayHubContract()->getTransactionHash());

        if($cardResponse->isOk()) {
            $cardData = (new \Backend\Modules\PayHub\Models\BaseModels\CardData())->unserialize(
                json_encode($cardResponse->getFromData('card_data')));

            $responseService = $this->recurrentPaymentRequest($cardData);
            if($responseService->isFail()) $this->phErr(__LINE__, __FILE__, $responseService);
        } else return $this->getJsonResponse($cardResponse);

        return $this->getJsonResponse($responseService);
    }

    public function payToCard(): JsonResponse
    {
        return $this->getJsonResponse(new ResponseService());
    }

    /**************** PayHub Log Trait **************/
    protected function getPayHubLoggingSystem(): string
    {
        return $this->system->getSystemKey() ?: $this->contract
            ->getPaymentData()->getPaySystemKey();
    }
}