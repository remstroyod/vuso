<?php

namespace Backend\Modules\PayHub\Models\BaseModels;

use Egorovwebservices\Payhub\Payhub;
use Egorovwebservices\Payhub\Traits\Log;
use Backend\Modules\PayHub\Models\PayHubSystem;
use Egorovwebservices\Payhub\Interfaces\Contract;
use Egorovwebservices\Payhub\Interfaces\User as PayHubUser;
use Egorovwebservices\Payhub\Models\Response as PayHubResponse;
use Egorovwebservices\Payhub\Interfaces\System as SystemInterface;
use Egorovwebservices\Payhub\Interfaces\PaymentData as PayhubPaymentData;

class PaymentSystemContract implements Contract, \Serializable, \JsonSerializable
{
    use Log;

    private string $transaction_hash = '';

    private string|null $transaction_id = null;

    private PayHubUser|null $User;
    private PayhubPaymentData $paymentData;

    public function __construct(PayHubUser $User = null, PayhubPaymentData $paymentData = null)
    {
        $this->User = $User;
        $this->paymentData = $paymentData ?: new PaymentData([]);
    }

    public function getPaySystemData(bool $is_recurrent = false, bool $has_3ds = true): SystemInterface
    {
        if(($id = $this->getPaymentData()->getPaySystemId()) > 0) {
            return (new PayHubSystem())->getById($id);
        }

        $System = new PayHubSystem();
        $builder = $System->getByKey($this->getPaymentData()->getPaySystemKey())
            ->where($System->getIsDefaultColumn(), 1);

        $builder->where($System->getIsRecurrentColumn(), intval($is_recurrent));
        return $builder->first();
    }

    public function setPaymentData(PayhubPaymentData $paymentData): void
    {
        $this->paymentData = $paymentData;
    }
    public function getPaymentData(): PayhubPaymentData
    {
        return $this->paymentData;
    }

    public function getUser(): PayHubUser
    {
        return $this->User;
    }

    public function getAmount(): float
    {
        return $this->paymentData->getAmount();
    }

    public function setTransactionId(mixed $transaction_id)
    {
        if($transaction_id !== null) {
            $transaction_id = strval($transaction_id);
        }

        $this->transaction_id = $transaction_id;
    }

    public function getTransactionId(): string|null
    {
        return $this->transaction_id;
    }

    public function getOrderId(): string
    {
        return $this->paymentData->getOrderId();
    }

    public function isRecurrent(): bool
    {
        return $this->paymentData->isRecurrent();
    }

    public function setTransactionHash(string $hash)
    {
        $this->transaction_hash = $hash;
    }

    public function getTransactionHash(): string
    {
        return $this->transaction_hash;
    }

    public function getPayHubService(): Payhub
    {
        return new Payhub();
    }

    public function serialize()
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * @param string $data
     * @return Contract
     */
    public function unserialize($data)
    {
        $data = json_decode($data);

        $user = (new User())->unserialize(json_encode($data->user));
        $paymentData = (new PaymentData())->unserialize(json_encode($data->payment_data));

        $contract = new self($user, $paymentData);

        if(property_exists($data, (new PayHubResponse())->getHashColumn())) {
            $contract->setTransactionHash($data->hash);
        }

        return $contract;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'user' => $this->getUser(),
            'payment_data' => $this->getPaymentData(),
            (new PayHubResponse())->getHashColumn() => $this->getTransactionHash()
        ];
    }

    /******************* Log trait ********************/
    protected function getPayHubLoggingSystem(): string
    {
        return $this->getPaymentData()->getPaySystemKey();
    }
}