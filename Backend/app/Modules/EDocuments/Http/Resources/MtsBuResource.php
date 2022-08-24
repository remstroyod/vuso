<?php

namespace Backend\Modules\EDocuments\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MtsBuResource extends JsonResource 
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'car_vin' => $this->getCarVin(),
        ];
    }
}
