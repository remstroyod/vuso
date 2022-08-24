<?php

namespace Backend\Http\Resources\API\v1\Dictionaries;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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

        $localeName = empty($request->locale) || $request->locale === 'ua' ? 'country_name_uk' : 'country_name_ru';

        return [
            'value' => $this->id,
            'name' => $this->$localeName,
        ];
    }

}
