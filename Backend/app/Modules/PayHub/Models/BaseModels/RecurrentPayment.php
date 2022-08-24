<?php

namespace Backend\Modules\PayHub\Models\BaseModels;

use Egorovwebservices\Payhub\Traits\Log;
use Egorovwebservices\Payhub\Interfaces\Contract;
use Egorovwebservices\Payhub\Interfaces\PaymentData;
use Egorovwebservices\Payhub\Interfaces\RecurrentPayment as PayHubRecurrentPayment;

class RecurrentPayment implements \Serializable, \JsonSerializable, PayHubRecurrentPayment
{
    use Log;

    private string $hash;
    private Contract|null $Contract = null;

    public function getTransactionHash(): string
    {
        return $this->hash;
    }

    public function getPaymentData(): PaymentData
    {
        return $this->Contract->getPaymentData();
    }

    /**
     * @param Contract $Contract
     */
    private function setContract(Contract $Contract): void
    {
        $this->Contract = $Contract;
    }

    public function getPayHubContract(): Contract
    {
        return $this->Contract;
    }

    public function serialize()
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * @param string $data
     * @return RecurrentPayment
     */
    public function unserialize($data)
    {
        $data = json_decode($data);

        $payment = new self();
        $payment->hash = $data->hash;

        $payment->setContract((new PaymentSystemContract())
            ->unserialize(json_encode($data->pay_hub_contract)));

        return $payment;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'hash' => $this->getTransactionHash(),
            'contract' => $this->getPayHubContract(),
            'payment_data' => $this->getPaymentData(),
        ];
    }

    /********************* PayHubLog trait **********************/
    protected function getPayHubLoggingSystem(): string
    {
        return '';
    }
}