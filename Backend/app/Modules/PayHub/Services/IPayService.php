<?php

namespace Backend\Modules\PayHub\Services;

use Backend\Modules\PayHub\Jobs\CompleteNewResponse;
use JetBrains\PhpStorm\Pure;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Support\Facades\Http;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Backend\Modules\PayHub\Models\BaseModels\CardData;

use Egorovwebservices\Payhub\Enums\StatusEnum;
use Egorovwebservices\Payhub\Interfaces\Contract;
use Egorovwebservices\Payhub\Interfaces\RecurrentPayment;
use Egorovwebservices\Response\Response as ResponseService;
use Egorovwebservices\Payhub\Models\Response as PayhubResponse;
use Egorovwebservices\Payhub\Interfaces\CardData as CardDataInterface;
use Egorovwebservices\Payhub\Interfaces\Service as PayHubServiceInterface;

class IPayService extends PayService implements PayHubServiceInterface
{
    protected int $lifeTime = 24;

    protected string $salt = '';
    protected string $currency = 'UAH';

    private array $response = [];

    const STATE_REGISTERED          = '1';
    const STATE_AUTH                = '3';
    const STATE_ERROR               = '4';
    const STATE_ACCEPTED            = '5';
    const STATE_DECLINED            = '9';

    private static array $states = [
        self::STATE_REGISTERED, self::STATE_AUTH,
        self::STATE_ERROR, self::STATE_ACCEPTED, self::STATE_DECLINED
    ];

    public function __construct(RecurrentPayment|Contract $service)
    {
        parent::__construct($service);

        $this->salt = sha1(microtime(true));
    }

    public function makeSign(): string
    {
        return hash_hmac('sha512', $this->salt, $this->system->secretKey);
    }

    #[Pure] #[ArrayShape(['mch_id' => "string", 'sign' => "string", 'salt' => "string"])]
    private function getAuthArray(): array
    {
        return [
            'mch_id' => intval($this->system->seviceKey),
            'sign' => $this->makeSign(),
            'salt' => $this->salt
        ];
    }

    #[Pure]
    private function getAuthXmlElement(): string
    {
        $auth_data = $this->getAuthArray();

        $auth = '<auth><mch_id>' . $auth_data['mch_id'] . '</mch_id>';
        $auth .= '<salt>' . $auth_data['salt'] . '</salt>';
        $auth .= '<sign>' . $auth_data['sign'] . '</sign>';

        return $auth . '</auth>';
    }

    private function createElementFromData(array $data): string
    {
        $element = '';

        foreach ($data as $key => $value) {
            if(is_array($value)) {
                $element .= '<'. $key .'>' . $this->createElementFromData($value) . '</' . $key . '>';
            } else $element .= '<'. $key .'>' . $value . '</' . $key . '>';
        }

        return $element;
    }

    private function getPaymentXmlElement(array $children = []): string
    {
        $payment = '<payment>' . $this->getAuthXmlElement();

        $payment .= $this->createElementFromData($children);
        return $payment . '</payment>';
    }

    private function getBaseXml(string $payment = ''): string
    {
        return '<?xml version="1.0" encoding="utf-8" standalone="yes"?>' . $payment;
    }

    private function getLang(): string
    {
        $lang = $this->contract->getPaymentData()->getLocale();
        if($lang === 'uk') $lang = 'ua';

        return $lang;
    }

    private function getAmount(): float|int
    {
        if($this->recurrentPayment) {
            $amount = $this->recurrentPayment->getPaymentData()->getAmount();
        } else $amount = $this->contract->getPaymentData()->getAmount();

        return $amount * 100;
    }

    private function getInfo(array $data = []): string
    {
        $info = array_merge([
            (new AcquiringResponse())->getSystemIdColumn() => $this->system->id,
            (new AcquiringResponse())->getHashColumn() => $this->contract->getTransactionHash(),
        ], $this->contract->getPaymentData()->getInfo());

        if($this->contract->getPaymentData()->getOrderId()) {
            $info['dogovor'] = $this->contract->getPaymentData()->getOrderId();
        }

        if($this->contract->getPaymentData()->isRecurrent()) {
            $info['user_id'] = md5(time() . $this->contract->getUser()->getId());
        }

        foreach ($data as $key => $value) {
            $info[$key] = $value;
        }

        return json_encode($info);
    }

    private function xmlRequest(string $xml, string $uri = ''): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        return Http::asMultipart()->post($this->system->urlApi . $uri, ['data' => $xml]);
    }

    /**
     * @return void
     */
    public function process()
    {
        return $this->paymentCreate();
    }

    /**
     * Регистрация точки
     * @return \Illuminate\Http\JsonResponse|void
     */
    private function paymentCreate()
    {
        $children = [
            'lifetime' => $this->lifeTime,
            'lang' => $this->getLang(),
            'urls' => [
                'good' => $this->contract->getPaymentData()->getSuccessRedirectUrl(),
                'bad' => $this->contract->getPaymentData()->getErrorRedirectUrl()
            ],
            'transactions' => [
                'transaction' => [
                    'currency' => 'UAH',
                    'amount' => $this->getAmount(),
                    'desc' => $this->contract->getPaymentData()->getDescription(),
                    'info' => $this->getInfo()
                ]
            ]
        ];
        $xml = $this->getBaseXml($this->getPaymentXmlElement($children));

        $responseService = (new ResponseService())->addData('request', $xml);
        try {
            $response = $this->xmlRequest($xml, '302');
            if( $response->failed() ) {
                $response = $response->json() ?? $response->body();

                if(! is_array($response)) {
                    $forbidden = stristr($response, '403 Forbidden');

                    if($forbidden) {
                        $forbidden = explode('<', $forbidden)[0];
                        $response = [$forbidden];
                    } else {
                        $xmlObject = simplexml_load_string($response);
                        $array = json_decode(json_encode($xmlObject), true);

                        if(is_array($array)) $response = $array;
                        else $response = [$response];
                    }
                }

                $responseService->addError($response);
            } else {
                $xmlObject = simplexml_load_string($response->body());
                $array = json_decode(json_encode($xmlObject), true);

                $responseService->addData('response', $array)->setOk();
            }
        } catch (\Throwable $exception) {
            $this->phExc($exception, __LINE__, __FILE__);
            $responseService->addError($exception->getMessage());
        }

        $this->phDbg(__LINE__, __FILE__, $responseService);
        $responseService = (new ResponseService())->setStatus($responseService->isOk())
            ->setData($responseService->getFromData('response'));

        return $this->getJsonResponse($responseService);
    }

    private function setResponse(array $acquiring_response): void
    {
        $xmlObject = simplexml_load_string($acquiring_response['xml']);
        $this->response = json_decode(json_encode($xmlObject), true);

        $this->phDbg(__LINE__, __FILE__, $this->response);
    }

    private function getTransactionArrayFromResponse(): array
    {
        return $this->response['transactions']['transaction'][0] ?? [];
    }

    private function getInfoArrayFromResponse(): array
    {
        $transaction = $this->getTransactionArrayFromResponse();
        $info = $transaction['info'] ?? '[]';

        return json_decode($info, true);
    }

    public function setHashFromAcquiringResponse(array $response)
    {
        $info = $this->getInfoArrayFromResponse();
        $hash = $info[(new AcquiringResponse())->getHashColumn()];

        $this->contract->setTransactionHash($hash);
    }

    public function setTransactionIdFromAcquiringResponse(array $response)
    {
        if($this->contract->getTransactionId() === null) {
            $this->contract->setTransactionId($this->response['@attributes']['id'] ?? null);
        }
    }

    public function setOrderIdFromAcquiringResponse(array $response)
    {
        $order_id = $this->getInfoArrayFromResponse()['dogovor'] ?? '';

        if(! $this->contract->getPaymentData()->getOrderId()) {
            $this->contract->getPaymentData()->setOrderId($order_id);
        }
    }

    public function setSystemIdFromAcquiringResponse(array $response)
    {
        $pay_system_id = $this->getInfoArrayFromResponse()[(new AcquiringResponse())->getSystemIdColumn()] ?? '';

        if(! $this->contract->getPaymentData()->getPaySystemId()) {
            $this->contract->getPaymentData()->setPaySystemId($pay_system_id);
        }
    }

    /* @var AcquiringResponse $Response */
    public function setAmountFromAcquiringResponse(PayhubResponse $Response, array $response): void
    {
        if($Response->amount === 0) {
            $amount = floatval($this->getTransactionArrayFromResponse()['amount'] ?? '0');
            if($amount > 0) $amount = round($amount / 100, 2);

            $Response->amount = $amount;
        }
    }

    public function getCardDataFromAcquiringResponse(array $response): CardDataInterface
    {
        $cardData = new CardData();

        $cardData->setLogin('');
        $cardData->setToken($response['card_token'] ?? '');

        return $cardData;
    }

    public function isPaymentResponse(array $response): bool
    {
        return true;
    }

    public function isCardDataResponse(array $response): bool
    {
        return key_exists('card_token', $response);
    }

    public function isCancelResponse(array $response): bool
    {
        $response = $response['response'] ?? false;
        if(! $response) return false;

        $pmt = boolval($response['pmt_id'] ?? false);
        $status = boolval($response['status'] ?? false);
        $date = boolval($response['sale_date'] ?? false);
        $transactions = boolval($response['transactions'] ?? false);

        return $pmt && $status && $date && $transactions;
    }

    public function paymentLinkGenerate(): JsonResponse
    {
        return $this->paymentCreate();
    }

    /**
     * @param AcquiringResponse $Response
     * @param null $status
     */
    public function setStatuses(PayhubResponse $Response, $status = null): void
    {
        if($status === null) return;
        if(intval($status) === 0) return;

        if(! in_array($status, self::$states)) {
            $this->phWrng(__LINE__, __FILE__, $this->response);
        }

        $Response->acquiring_status = $status;
        if(strval($status) === self::STATE_REGISTERED) {
            $Response->payhub_status = StatusEnum::STATUS_WAIT;
        }

        if(strval($status) === self::STATE_AUTH) {
            $Response->payhub_status = StatusEnum::STATUS_WAIT;
        }

        if(strval($status) == self::STATE_ERROR) {
            $Response->payhub_status = StatusEnum::STATUS_ERROR;
        }

        if(strval($status) === self::STATE_ACCEPTED) {
            $Response->payhub_status = StatusEnum::STATUS_SUCCESS;
        }

        if(strval($status) === self::STATE_DECLINED) {
            $Response->payhub_status = StatusEnum::STATUS_CANCELED;
        }
    }

    public function parseAcquiringResponse(array $acquiring_data): PayhubResponse
    {
        $this->setResponse($acquiring_data);

        /** @var AcquiringResponse $Response */
        $Response = parent::parseAcquiringResponse($this->response);
        $Response->state_data = $this->response;

        $this->setStatuses($Response, $this->response['status'] ?? null);
        return $Response;
    }

    /* @var AcquiringResponse $Response */
    public function getReceiptLink(PayhubResponse $Response): void
    {
        $ident = $Response->payment_data['ident'] ?? false;
        if($ident) $Response->receipt = 'https://secure.ipay.ua/invoice/' . $ident;
    }

    /* @var AcquiringResponse $Response */
    public function getReceipt(PayhubResponse $Response): ResponseService
    {
        return (new ResponseService())->addData('link', $Response->receipt ?? '')
            ->setStatus(boolval($Response->receipt));
    }

    /**
     * @param AcquiringResponse $Response
     * @return JsonResponse
     */
    public function orderState(PayhubResponse $Response): JsonResponse
    {
        return $this->getJsonResponse((new ResponseService())
            ->setData($Response->getStateResponse())->setOk());
    }

    /**
     * @param AcquiringResponse $Response
     * @return JsonResponse
     */
    public function cancelPayment(PayhubResponse $Response): JsonResponse
    {
        if(strval($Response->getCancelResponse()['data']['status'] ?? false) === self::STATE_DECLINED) {
            $this->setStatuses($Response, $Response->getCancelResponse()['data']['status']);
        }

        if($Response->acquiring_status === self::STATE_DECLINED) {
            $this->setStatuses($Response, $Response->acquiring_status);
        }

        if($Response->isStatus(StatusEnum::STATUS_CANCELED)) {
            $Response->save();

            return $this->getJsonResponse((new ResponseService())
                ->setData($Response->getCancelResponse())->setOk());
        }
        if(! $Response->isStatus(StatusEnum::STATUS_SUCCESS)) {
            if($Response->acquiring_status !== self::STATE_AUTH) {
                return $this->getJsonResponse((new ResponseService())->addError('Incorrect status for cancel'));
            }
        }

        $request = [
            'request' => [
                'auth' => $this->getAuthArray(),
                'action' => 'Reversal',
                'body' => [ 'pmt_id' => $Response->transaction_id ]
            ],
        ];
        $response = Http::post($this->system->urlApi, $request);
        $this->phDbg(__LINE__, __FILE__, $response->json());

        $Response->cancel_data = $response->json('response', $response->json());
        if(($Response->getCancelResponse()['status'] ?? false) == self::STATE_DECLINED) {
            $this->setStatuses($Response, $Response->cancel_data['response']['status']);
        }
        $Response->save();

        if($response->ok()) {
            $response = (new ResponseService())->setData($Response->getCancelResponse())->setOk();
        } else $response = (new ResponseService())->setErrors($Response->getCancelResponse());

        return $this->getJsonResponse($response);
    }

    public function initBaseRecurrentPaymentResponse(ResponseService $response): AcquiringResponse
    {
        $Response = new AcquiringResponse();
        $Response->payment_data = $response->getFromData('response');

        $Response->transaction_id = $Response->payment_data['pmt_id'] ?? '0';
        $Response->acquiring_status = $Response->payment_data['status'] ?? self::STATE_ERROR;

        return $Response;
    }

    public function recurrentPaymentRequest(CardDataInterface $cardData): ResponseService
    {
        $request = [
            'action' => 'Debiting',
            'auth' => $this->getAuthArray(),
            'body' => [
                'invoice' => $this->getAmount(),
                'card' => ['token' => $cardData->getToken()],
                'info' => $this->recurrentPayment->getPaymentData()->getInfo(),
                'desc' => $this->recurrentPayment->getPaymentData()->getDescription()
            ]
        ];
        $response = Http::post($this->system->urlApi, ['request' => $request]);

        $responseService = (new ResponseService())->setStatus($response->ok());
        if($responseService->isOk()) {
            $responseService->setData($response->json());
            $responseService = $this->parsePayRecurrentPaymentResponse($responseService);
        } else {
            $response = ($response->json('response') ?? $response->json()) ?? $response->body();
            $responseService->addError($response);
        }

        return $responseService->addData('request', $request);
    }

    public function payToCard(): JsonResponse
    {
        $responseService = new ResponseService();

        $Response = $this->initBasePayToCardResponse($responseService);
        $Response->amount = $this->contract->getPaymentData()->getAmount();

        $info = $this->contract->getPaymentData()->getInfo();

        $sender = [
            'address' => '',
            'lastname' => '',
            'middlename' => '',
            'firstname' => $info['sender']['name'],
            'document' => $info['sender']['edrpou'],
        ];
        $receiver = [
            'firstname' => $info['client']['pib'],
        ];

        $request = [
            'request' => [
                'auth' => $this->getAuthArray(),
                'action' => 'A2CPay',
                'body' => [
                    'sender' => $sender,
                    'receiver' => $receiver,
                    'invoice' => $this->getAmount(),
                    'info' => [
                        'inn' => $info['client']['code'],
                        'receiver_bank' => $info['sender']['bank']
                    ],
                    'ext_id' => $this->contract->getPaymentData()->getOrderId(),
                    'card' => $this->contract->getUser()->getCardData()->getCard()
                ]
            ]
        ];
        $responseService->addData('request', $request['request']);

        $payResponse = Http::post($this->system->urlApi, $request);

        $response = $payResponse->json() ?? [];
        if($response) $response = $response['response'] ?? $response;

        $responseService->addData('response', $response);

        $Response->payment_data = $response;
        $this->setStatuses($Response, $response['status'] ?? self::STATE_ERROR);

        if($payResponse->ok()) {
            if($response['pmt_id'] ?? false) {
                $Response->transaction_id = $response['pmt_id'];
                $responseService->setStatus($Response->save());
            }
        } else $responseService->addError($response);

        if($responseService->isFail()) $this->phErr(__LINE__, __FILE__, $responseService);
        return $this->getJsonResponse($responseService);
    }
}
