<?php

namespace Backend\Modules\PayHub\Models\BaseModels;

use JetBrains\PhpStorm\Pure;
use \Egorovwebservices\Payhub\Interfaces\User as PayhubUser;
use Egorovwebservices\Payhub\Interfaces\CardData as PayhubCardData;

class User implements \Serializable, \JsonSerializable, PayhubUser
{
    private CardData $cardData;

    private int $id = 0;

    private string|null $phone = null;
    private string|null $email = null;
    private string|null $name = null;

    #[Pure]
    public function __construct()
    {
        $this->cardData = new CardData();
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone ?? '';
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string|null
    {
        return $this->email ?? '';
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name ?? '';
    }

    public function getCardData(): PayhubCardData
    {
        return $this->cardData;
    }

    public function serialize()
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * @param string $data
     * @return PayhubUser
     */
    public function unserialize($data)
    {
        $data = json_decode($data);

        $user = new self();

        if(property_exists($data, 'name')) {
            $user->name = $data->name;
        }

        if(property_exists($data, 'phone')) {
            $user->phone = $data->phone;
        }

        if(property_exists($data, 'email')) {
            $user->email = $data->email;
        }

        if(property_exists($data, 'card_data')) {
            $user->cardData = (new CardData())->unserialize(json_encode($data->card_data));
        }

        return $user;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'card_data' => $this->getCardData()
        ];
    }
}