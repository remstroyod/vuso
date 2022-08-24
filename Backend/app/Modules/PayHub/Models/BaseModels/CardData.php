<?php

namespace Backend\Modules\PayHub\Models\BaseModels;

use Egorovwebservices\Payhub\Interfaces\CardData as PayhubCardData;
use Egorovwebservices\Payhub\Models\Log;

class CardData implements PayhubCardData, \Serializable, \JsonSerializable
{
    private array $card_data = [];

    public function setLogin($login)
    {
        if(! is_string($login)) $login = strval($login);

        $this->card_data['login'] = $login;
    }

    public function getLogin(): string
    {
        return $this->card_data['login'] ?? '';
    }

    public function setToken($token)
    {
        if(! is_string($token)) $token = strval($token);

        $this->card_data['token'] = $token;
    }

    public function getToken(): string
    {
        return $this->card_data['token'] ?? '';
    }

    public function getCard(): array
    {
        return $this->card_data['card'] ?? [];
    }

    public function setCard(array $card)
    {
        $this->card_data['card'] = $card;
    }

    public function serialize()
    {
        return json_encode($this->jsonSerialize());
    }

    public function unserialize($data)
    {
        $data = json_decode($data, true);

        $cardData = new CardData();

        $cardData->setLogin($data['login']);
        $cardData->setToken($data['token']);

        if($data['card'] ?? false) {
            $cardData->setCard($data['card']);
        }

        (new Log())->dbg(__LINE__, __FILE__, $cardData);
        return $cardData;
    }

    public function jsonSerialize()
    {
        return [
            'card' => $this->getCard(),
            'login' => $this->getLogin(),
            'token' => $this->getToken(),
            'other_data' => $this->card_data,
        ];
    }
}