<?php

namespace Frontend\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'id' => $this->user->id,
            'name' => $this->name,
        ];
    }

}
