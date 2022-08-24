<?php

namespace Backend\Http\Resources\API\v1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $detail = $this->detail;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'first_name' => $detail->first_name,
            'last_name' => $detail->last_name,
            'middle_name' => $detail->middle_name,
            'birthday' => $detail->birthday,
            'avatar' => $detail->avatar,
            'country' => $detail->country,
            'city' => $detail->city,
            'street' => $detail->street,
            'house_number' => $detail->house_number,
            'apartment_number' => $detail->apartment_number,
            'passport_id' => $detail->passport_id,
            'identification_number' => $detail->identification_number,
            'international_first_name' => $detail->international_first_name,
            'international_last_name' => $detail->international_last_name,
            'international_passport_id' => $detail->international_passport_id,
            'international_passport_series' => $detail->international_passport_series,
            'phone' => $detail->phone,
        ];
    }

}
