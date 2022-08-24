<?php

namespace Backend\Modules\PayHub\Services;

use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Backend\Modules\PayHub\Models\BaseModels\CardData;

use Egorovwebservices\Payhub\Enums\StatusEnum;
use Egorovwebservices\Payhub\Interfaces\Contract;
use Egorovwebservices\Payhub\Interfaces\RecurrentPayment;
use Egorovwebservices\Response\Response as ResponseService;
use Egorovwebservices\Payhub\Models\Response as PayhubResponse;
use Egorovwebservices\Payhub\Interfaces\CardData as CardDataInterface;
use Egorovwebservices\Payhub\Interfaces\Service as PayHubServiceInterface;

class EasyPayService extends PayService implements PayHubServiceInterface
{
    private const PAYMENT_OPERATION_TOKENIZATION    = "PaymentTokenization";

    private const ACTION_REFUND     = 'refund';
    private const ACTION_PAYMENT    = 'payment';

    const STATE_ACCEPTED            = 'accepted';
    const STATE_DECLINED            = 'declined';
    const STATE_PENDING             = 'pending';

    private static array $states = [
        self::STATE_ACCEPTED, self::STATE_DECLINED, self::STATE_PENDING
    ];

    /**
     * @var
     * идентификатор торговой точки партнера (параметр валиден на протяжении 90 дней. Один и тот же AppID может использоваться для нескольких платежей)
     */
    protected string|null $appId = null;

    /**
     * @var
     * идентификатор сессии (параметр валиден на протяжении 20 мин. Для каждого запроса CreateOrder нужно использовать уникальный PageID)
     */
    protected string $pageId;

    protected string|null $sessionId = null;

    private function getRequestDataJson(array $request_data): string
    {
        return json_encode($request_data, JSON_UNESCAPED_SLASHES);
    }

    private function getSign(array $request_data): string
    {
        $request_body = $this->getRequestDataJson($request_data);
        return base64_encode((hash('sha256', $this->system->secretKey . $request_body, 1)));
    }

    #[ArrayShape(['AppId' => "null|string", 'PageId' => "string", 'Sign' => "string", 'Content-Type' => "string", 'PartnerKey' => "string", 'locale' => "string"])]
    private function getFinalHeaders(array $request_data): array
    {
        return [
            'AppId' => $this->appId,
            'PageId' => $this->pageId,
            'Content-Type' => 'application/json',
            'Sign' => $this->getSign($request_data),
            'PartnerKey' => $this->system->partnerKey,
            'locale' => $this->contract->getPaymentData()->getLocale() ?: 'ua'
        ];
    }

    #[ArrayShape(['order' => "array"])]
    private function getBaseOrderArray(): array
    {
        $service = $this->recurrentPayment ?: $this->contract;

        return [
            'order' => [
                'serviceKey'        => $this->system->seviceKey,
                'amount'            => $service->getPaymentData()->getAmount(),
                'orderId'           => $service->getPaymentData()->getOrderId(),
                'description'       => $service->getPaymentData()->getDescription(),
                'additionalItems'   => [
                    'Merchant.UrlNotify' => $this->webhook_url,
                    'Merchant.' . (new AcquiringResponse())->getSystemIdColumn() => $this->system->id,
                    'Merchant.' . (new AcquiringResponse())->getHashColumn() => $service->getTransactionHash()
                ]
            ]
        ];
    }

    /** Регистрация точки */
    protected function createApp(): ResponseService
    {
        $respService = new ResponseService();
        try {
            $response = Http::withHeaders([
                'PartnerKey'    => $this->system->partnerKey,
                'locale'        => $this->contract->getPaymentData()->getLocale() ?: 'ua'
            ])->post($this->system->urlApi . '/api/system/createApp');

            if($response->ok()) {
                $respService->setOk()->setData($response->json());

                $this->appId = $respService->getFromData('appId');
                $this->pageId = $respService->getFromData('pageId');
                $this->sessionId = $respService->getFromData('requestedSessionId');
            } else $respService->setErrors([__( 'Ошибка создания точки соединения' )]);
        } catch (\Throwable $exception) {
            $respService->addError([$exception->getMessage()]);
        }

        return $respService;
    }

    public function createOrder(array $order): ResponseService
    {
        if(($app = $this->createApp())->isFail()) return $app;

        if($this->contract->getPaymentData()->isRecurrent()) {
            $order['order']['paymentOperation'] = self::PAYMENT_OPERATION_TOKENIZATION;
        }

        $response = Http::withHeaders($this->getFinalHeaders($order))->withBody($this->getRequestDataJson($order), 'application/json')
            ->post($this->system->urlApi . '/api/merchant/createOrder');

        return (new ResponseService())->setData($response->json())->setStatus($response->ok());
    }

    /** Создание сессии */
    protected function createPage(): ResponseService
    {
        $response = new ResponseService();
        try {
            $order = $this->getBaseOrderArray();

            $order['userInfo'] = ['phone' => $this->contract->getUser()->getPhone()];
            $order['urls'] = [
                'success'       => $this->contract->getPaymentData()->getSuccessRedirectUrl(),
                'failed'        => $this->contract->getPaymentData()->getErrorRedirectUrl()
            ];

            if(($order = $this->createOrder($order))->isOk()) {
                $response->setOk()->addData('url', $order->getFromData('forwardUrl'));
            } else $response->setErrors([$order->getErrors()]);
        } catch (\Throwable $exception) {
            $response->addError($exception->getMessage());
        }

        return $response;
    }

    /**
     * @param AcquiringResponse $Response
     * @param null $status
     */
    public function setStatuses(PayhubResponse $Response, $status = null): void
    {
        $Response->acquiring_status = $status;
        if($status !== null && !in_array($status, self::$states)) {
            $this->phWrng(__LINE__, __FILE__, $Response->acquiring_status);
        }

        if($Response->acquiring_status === self::STATE_PENDING) {
            $Response->payhub_status = StatusEnum::STATUS_WAIT;
        }

        if($Response->acquiring_status === self::STATE_ACCEPTED) {
            $Response->payhub_status = StatusEnum::STATUS_SUCCESS;
        }

        if($Response->acquiring_status === self::STATE_DECLINED) {
            $Response->payhub_status = StatusEnum::STATUS_CANCELED;
        }
    }

    public function setHashFromAcquiringResponse(array $response)
    {
        $hash = $response['additionalitems']['Merchant.hash'] ?? null;
        if($hash) $this->contract->setTransactionHash($hash);
    }

    public function setTransactionIdFromAcquiringResponse(array $response)
    {
        $this->contract->setTransactionId($response['details']['payment_id'] ?? null);
        if($this->contract->getTransactionId() === null) $this->contract->setTransactionId($response['transactionId'] ?? null);
    }

    public function setOrderIdFromAcquiringResponse(array $response)
    {
        $order_id = $response['additionalitems']['Merchant.OrderId'] ?? null;

        if($order_id === null) $order_id = $response['orderId'] ?? null;
        if($order_id === null) $order_id = $response['order_id'] ?? null;

        if($order_id) $this->contract->getPaymentData()->setOrderId($order_id);
    }

    public function setSystemIdFromAcquiringResponse(array $response)
    {
        $system_id = $response['additionalitems']['Merchant.' . (new AcquiringResponse())->getSystemIdColumn()] ?? null;

        if($system_id) $this->contract->getPaymentData()->setPaySystemId($system_id);
    }

    /* @var AcquiringResponse $Response */
    public function setAmountFromAcquiringResponse(PayhubResponse $Response, array $response): void
    {
        if($Response->amount === 0) {
            $Response->amount = $response['details']['amount'] ?? 0;
        }
    }

    public function getCardDataFromAcquiringResponse(array $response): CardDataInterface
    {
        $cardData = new CardData();

        $cardData->setLogin($response['380505094311'] ?? '');
        $cardData->setToken($response['cardGuid'] ?? '');

        return $cardData;
    }

    public function isPaymentResponse(array $response): bool
    {
        $action = $response["action"] ?? false;
        if($action !== false) $action = $action === self::ACTION_PAYMENT;

        $merchant_id = boolval($response["merchant_id"] ?? false);
        $success_order_id = boolval($response["order_id"] ?? false);

        $error_order_id = boolval($response["orderId"] ?? false);
        $transaction_id = boolval($response["transactionId"] ?? false);
        $error = boolval($response["errorCode"] ?? false);

        return ($action && $merchant_id && $success_order_id)
            || ($transaction_id && $error_order_id && $error);
    }

    /**
     * @param array $response
     * @return bool
     */
    public function isCardDataResponse(array $response): bool
    {
        $phone = $response['phone'] ?? false;
        $card_guid = $response['cardGuid'] ?? false;

        return $phone && $card_guid;
    }

    public function isCancelResponse(array $response): bool
    {
        $action = $response["action"] ?? null;
        if($action === null) $action = true;
        else $action = $action === self::ACTION_REFUND;

        $order_id = boolval($response['orderId'] ?? false);
        $refund = key_exists('refundTransactionId',$response);
        $transaction_id = boolval($response['transactionId'] ?? false);

        return $action && $refund && $order_id && $transaction_id;
    }

    public function paymentLinkGenerate(): JsonResponse
    {
        $response = $this->createPage();
        $http = $response->isOk() ? Response::HTTP_OK : Response::HTTP_UNPROCESSABLE_ENTITY;

        return $this->getJsonResponse($response, $http);
    }

    /* @var AcquiringResponse $Response */
    public function getReceiptLink(PayhubResponse $Response): void
    {
        $payment_data = $Response->payment_data;

        $amount = $payment_data['details']['amount'] ?? false;

        if($amount) {
            $link = 'https://merchantapi.easypay.ua/api/payment/getReceipt?';
            $link .= 'receiptId=' . $Response->transaction_id . '&amount=' . $amount;

            $Response->receipt = $link;
        }
    }

    /* @var AcquiringResponse $Response */
    public function getReceipt(PayhubResponse $Response): ResponseService
    {
        return (new ResponseService())->addData('type', 'application/pdf')
            ->addData('link', $Response->receipt ?? '')
            ->setStatus(boolval($Response->receipt));
    }

    /**
     * @param AcquiringResponse $Response
     * @return JsonResponse
     */
    public function orderState(PayhubResponse $Response): JsonResponse
    {
        $respService = $this->createApp();
        if(! $respService->isOk()) {
            return response()->json($respService,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $order = [
            'serviceKey' =>  $this->system->seviceKey,
            'transactionId' =>  $Response->transaction_id
        ];

        $response = Http::withHeaders($this->getFinalHeaders($order))
            ->post($this->system->urlApi . '/api/merchant/orderState', $order);

        $respService = new ResponseService();
        $Response->state_data = $response->json();
        if($response->failed()) $respService->setData($Response->getStateResponse());
        else {
            $this->setStatuses($Response, $Response->getStateResponse()['data']['paymentState'] ?? null);
            $respService->setStatus(true)->setData($Response->getStateResponse());
        }
        $Response->save();

        return response()->json($respService);
    }

    /**
     * @param AcquiringResponse $Response
     * @return JsonResponse
     */
    public function cancelPayment(PayhubResponse $Response): JsonResponse
    {
        $respService = $this->createApp();
        if(! $respService->isOk()) return response()->json($respService);
        $respService->setStatus(false)->setData([]);

        $this->orderState($Response);
        if($Response->isStatus(StatusEnum::STATUS_CANCELED)) {
            $respService->setStatus(true)->setData($Response->getCancelResponse());

            return response()->json($respService);
        }
        if(! $Response->isStatus(StatusEnum::STATUS_SUCCESS)) {
            $respService
                ->addError('Incorrect status for cancel');

            return response()->json($respService);
        }

        try {
            $request_data = [
                'orderId' => $Response->order_id,
                'serviceKey' => $this->system->seviceKey,
                'transactionId' => intval($Response->transaction_id)
            ];
            $headers = $this->getFinalHeaders($request_data);

            $response = Http::withHeaders($headers)
                ->post($this->system->urlApi . '/api/merchant/cancelOrder', $request_data);

            $Response->cancel_data = $response->json('error', $response->json()) ?? $response->json();
            $Response->save();

            if($response->ok()) {
                return $this->orderState($Response);
            } else $respService->setErrors($Response->getCancelResponse());
        } catch (\Throwable $ex) {
            $respService->addError($ex->getMessage());
            $this->phExc($ex, __LINE__, __FILE__, $respService);
        }

        return response()->json($respService);
    }

    public function initBaseRecurrentPaymentResponse(ResponseService $response): AcquiringResponse
    {
        $Response = new AcquiringResponse();
        $Response->payment_data = $response->getFromData('response');

        $Response->transaction_id = $Response->payment_data['pmt_id'] ?? '0';
        $Response->acquiring_status = $Response->payment_data['status'] ?? self::STATE_PENDING;

        return $Response;
    }

    public function recurrentPaymentRequest(CardDataInterface $cardData): ResponseService
    {
        $order = $this->getBaseOrderArray();

        $order['userInfo'] = [
            "phone" => $cardData->getLogin()
        ];
        $order['userPaymentInstrument'] = [
            "instrumentType" => "Card",
            "cardGuid" => $cardData->getToken()
        ];

        $response = (new ResponseService())->addData('request', $order);
        if(($order = $this->createOrder($order))->isOk()) {
            $response->addData('response', $order->getData());
            $response = $this->parsePayRecurrentPaymentResponse($response);
        }

        $this->phDbg(__LINE__, __FILE__, $response);
        return $response;
    }
}
