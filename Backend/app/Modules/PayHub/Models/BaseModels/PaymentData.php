<?php

namespace Backend\Modules\PayHub\Models\BaseModels;

use Egorovwebservices\Payhub\Traits\Log;
use Backend\Modules\PayHub\Models\AcquiringResponse;
use Egorovwebservices\Payhub\Interfaces\PaymentData as PayhubPaymentData;

class PaymentData implements PayhubPaymentData, \Serializable, \JsonSerializable
{
    use Log;

    protected string $order_id = '';
    protected float|int $amount = 0;

    protected array $payment_data;

    public function __construct(array $data = [])
    {
        $this->payment_data = $data;
    }

    public function getPaySystemKey(): string
    {
        return $this->payment_data['payment_system'] ?? '';
    }

    public function setPaySystemId(int $id): void
    {
        $this->payment_data[(new AcquiringResponse())->getSystemIdColumn()] = $id;
    }

    public function getPaySystemId(): int
    {
        return $this->payment_data[(new AcquiringResponse())->getSystemIdColumn()] ?? 0;
    }

    public function isRecurrent(): bool
    {
        return boolval($this->payment_data['is_recurrent'] ?? false);
    }

    public function setRecurrent($isRecurrent): void
    {
        $this->payment_data['is_recurrent'] = $isRecurrent;
    }

    public function setOrderId($order_id): void
    {
        if(! is_string($order_id)) $order_id = strval($order_id);

        $this->order_id = $order_id;
    }

    public function getOrderId(): string
    {
        return $this->order_id;
    }

    public function setAmount(float|int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): int|float
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return strval($this->payment_data['description'] ?? '');
    }

    public function setDescription($description): void
    {
        $this->payment_data['description'] = $description;
    }

    public function setInfo(array $info): void
    {
        $this->payment_data['info'] = $info;
    }

    public function getInfo(): array
    {
        return $this->payment_data['info'] ?? [];
    }

    public function getErrorRedirectUrl(): string
    {
        return $this->payment_data['error_redirect_url'] ?? '';
    }

    public function setTransactionHash(string $hash)
    {
        $this->payment_data['transaction_hash'] = $hash;
    }

    public function getTransactionHash(): string
    {
        return $this->payment_data['transaction_hash'];
    }

    public function getSuccessRedirectUrl(): string
    {
        return $this->payment_data['success_redirect_url'] ?? '';
    }

    public function setErrorRedirectUrl(string $url)
    {
        $this->payment_data['error_redirect_url'] = $url;
    }

    public function setSuccessRedirectUrl(string $url)
    {
        $this->payment_data['success_redirect_url'] = $url;
    }

    public function getLocale(): string
    {
        return $this->payment_data['locale'] ?? app()->getLocale();
    }

    public function setLocale($lang): void
    {
        $this->payment_data['locale'] = $lang;
    }

    public function serialize(): string
    {
        return json_encode($this->jsonSerialize());
    }

    public function unserialize($data): PaymentData
    {
        $data = json_decode($data, true);

        $paymentData = new self($data);
        $paymentData->setOrderId($data['order_id']);

        $paymentData->setAmount($data['amount']);

        if($data['pay_system_id'] ?? false) {
            $paymentData->setPaySystemId(intval($data['pay_system_id']));
        } else {
            $this->payment_data['payment_system'] = $data['payment_system'];
        }

        return $paymentData;
    }

    public function jsonSerialize()
    {
        $data = $this->payment_data;

        $data['order_id'] = $this->getOrderId();
        $data['amount'] = $this->getAmount();
        $data['payment_system'] = $this->getPaySystemKey();
        $data['pay_system_id'] = $this->getPaySystemId();

        return $data;
    }

    /********************** PayHub Log Trait ***********/
    protected function getPayHubLoggingSystem(): string
    {
        return $this->getPaySystemKey();
    }
}