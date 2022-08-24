<?php

namespace Backend\Modules\PayHub\Models;

use JetBrains\PhpStorm\ArrayShape;
use Egorovwebservices\Payhub\Models\Response;
use Egorovwebservices\Payhub\Enums\StatusEnum;
use Backend\Modules\PayHub\Services\PayService;
use Egorovwebservices\Payhub\Interfaces\Contract;
use Backend\Modules\PayHub\Models\BaseModels\User;
use Egorovwebservices\Payhub\Enums\PaySystemsEnum;
use Backend\Modules\PayHub\Jobs\CompleteNewResponse;
use Egorovwebservices\Payhub\Traits\Log as PayHubLog;
use Backend\Modules\PayHub\Models\BaseModels\CardData;
use Backend\Modules\PayHub\Models\BaseModels\PaymentData;
use Egorovwebservices\Response\Response as ResponseService;
use Backend\Modules\PayHub\Models\BaseModels\PaymentSystemContract;
use Egorovwebservices\Payhub\Interfaces\CardData as CardDataInterface;

/**
 * @property int $id
 * @property string $hash
 * @property string $transaction_id
 * @property string $order_id
 * @property string $acquiring_status
 * @property string $payhub_status
 * @property int $system_id
 * @property string $system_name
 * @property float $amount
 * @property array $response_data
 * @property array $cancel_data
 * @property array $state_data
 * @property CardData $card_data
 * @property string $receipt
 *
 * @property array $payment_data
 */
class AcquiringResponse extends Response
{
    use PayHubLog;

    protected $table = 'payhub_acquiring_responses';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->response_data = [];
        if(! $this->amount) $this->amount = 0;
    }

    /************** Mutators ***********************/
    public function setTransactionIdAttribute($value)
    {
        if(! is_string($value)) $value = strval($value);
        $this->attributes[$this->getTransactionIdColumn()] = $value;
    }

    public function setAcquiringStatusAttribute($value)
    {
        if(! is_string($value)) $value = strval($value);
        $this->attributes[$this->getAcquiringStatusColumn()] = $value;
    }

    public function getResponseDataAttribute($value): array
    {
        return json_decode($value, true) ?? [];
    }

    public function setResponseDataAttribute($value)
    {
        $this->attributes[$this->getResponseDataColumn()] = json_encode($value);
    }

    public function getPaymentDataAttribute($value): array
    {
        return $this->response_data['payment_data'] ?? [];
    }

    public function setPaymentDataAttribute($value)
    {
        if(! is_array($value)) $value = [$value];

        $data = $this->response_data;
        $data['payment_data'] = $value;

        $this->response_data = $data;
    }

    public function getCancelDataAttribute($value): array
    {
        if($value === null) return [];

        return json_decode($value, true) ?? [];
    }

    public function setCancelDataAttribute($data)
    {
        if(! is_array($data)) return;
        if(count($data) === 0) return;

        $states = $this->cancel_data;
        if(count($states) === 0) $states[] = $data;
        else {
            $state = $states[count($states) - 1];
            if(! $this->arrayEqual($state, $data)) {
                $states[] = $data;
            }
        }

        $this->attributes[$this->getCancelDataColumn()] = json_encode($states);
    }

    public function getStateDataAttribute($value): array
    {
        if($value === null) return [];

        return json_decode($value, true) ?? [];
    }

    public function setStateDataAttribute($data)
    {
        if(! is_array($data)) return;
        if(count($data) === 0) return;

        $states = $this->state_data;
        if(count($states) === 0) $states[] = $data;
        else {
            $state = $states[count($states) - 1];

            if($this->system_name ===  PaySystemsEnum::SYSTEM_EASYPAY && ($data['paymentState'] ?? false) === $state['paymentState']) {
                $states[count($states) - 1] = $data;
            } else $states[] = $data;
        }

        $this->attributes[$this->getStateDataColumn()] = json_encode($states);
    }

    public function getCardDataAttribute($value): CardData|null
    {
        $card_data = json_decode($value, true);
        if(count($card_data) === 0) return null;

        $cardData = new CardData();

        $cardData->setLogin($card_data['login']);
        $cardData->setToken($card_data['token']);

        return $cardData;
    }

    public function setCardDataAttribute(CardDataInterface $cardData)
    {
        $this->attributes[$this->getCardDataColumn()] = json_encode($cardData);
    }

    /*************** PayHub Log Trait **********************/
    public function getPayHubLoggingSystem(): string
    {
        return $this->system_name;
    }

    private function arrayEqual(array $arr_1, array $arr_2): bool
    {
        $equal = true;

        foreach($arr_1 as $key => $value) {
            if($equal) $equal = key_exists($key, $arr_2);
            else break;

            if($equal) {
                if(is_array($arr_2[$key])) {
                    $equal = $this->arrayEqual($value, $arr_2[$key]);
                } else $equal = mb_strtoupper($value) === mb_strtoupper($arr_2[$key]);
            } else break;
        }

        return $equal;
    }

    public function getByHash(string $hash): AcquiringResponse|null
    {
        return self::query()->where($this->getHashColumn(), $hash)->first();
    }

    public function getByTransactionId(string $transaction_id): AcquiringResponse|null
    {
        return self::query()->where($this->getTransactionIdColumn(), $transaction_id)->first();
    }

    public function isStatus(string $status): bool
    {
        return $status === $this->payhub_status;
    }

    public static function parseAcquiringResponse(Contract $contract, array $data): bool
    {
        $service = (new PayService($contract))->getServiceByContract();
        $Acquiring = $service->parseAcquiringResponse($data);

        $status = $Acquiring->save();
        if($status) dispatch(new CompleteNewResponse($Acquiring));

        return $status;
    }

    public function getResponse(): ResponseService
    {
        $response = new ResponseService();

        try {
            $response->setData($this->response_data)->setOk();
        } catch (\Throwable $exception) {
            $this->phExc($exception, __LINE__, __FILE__);
            $response->addError($exception->getMessage());
        }

        return $response;
    }

    #[ArrayShape(['status' => "string", 'data' => "mixed"])]
    public function getCancelResponse(): array
    {
        $cancel = [];
        foreach (array_reverse($this->cancel_data) as $datum) {
            $cancel = $datum;
            break;
        }

        return [
            'status' => $this->payhub_status,
            'data' => $cancel
        ];
    }

    #[ArrayShape(['status' => "string", 'data' => "mixed"])]
    public function getStateResponse(): array
    {
        $state = [];
        foreach (array_reverse($this->state_data) as $datum) {
            $state = $datum;
            break;
        }

        unset($state['card_token']);

        return [
            'status' => $this->payhub_status ?? StatusEnum::STATUS_WAIT,
            'data' => $state
        ];
    }

    public function getReceipt(): bool
    {
        if(! $this->receipt) {
            $paymentData = new PaymentData(['payment_system' => $this->system_name]);
            $paymentData->setPaySystemId($this->system_id);

            $contract = new PaymentSystemContract(new User(), $paymentData);
            $service = (new PayService($contract))->getServiceByContract();
            $service->getReceiptLink($this);

            if($this->receipt) $this->save();
        }

        return boolval($this->receipt);
    }
}