<?php

namespace Frontend\Http\Resources\API\v1\Promocode;

use Illuminate\Http\Resources\Json\JsonResource;

class PromocodeResource extends JsonResource
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
        return [
            'id' => $this->id,
            'code' => $this->code,
            'reward' => $this->reward,
            'reward_type' => $this->data->reward_type,
            'description' => $this->description,
            'type' => $this->type,
            'is_disposable' => $this->is_disposable,
        ];
    }

}
