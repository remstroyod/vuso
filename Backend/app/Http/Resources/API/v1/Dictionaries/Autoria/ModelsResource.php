<?php

namespace Backend\Http\Resources\API\v1\Dictionaries\Autoria;

use Illuminate\Http\Resources\Json\JsonResource;

class ModelsResource extends JsonResource
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
            'value' => $this->id,
            'name' => $this->name,
        ];
    }

}
