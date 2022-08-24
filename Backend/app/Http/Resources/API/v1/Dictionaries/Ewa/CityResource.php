<?php

namespace Backend\Http\Resources\API\v1\Dictionaries\Ewa;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{

    public function __construct($resource) {
        self::withoutWrapping(); 
        parent::__construct($resource); 
    }

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

        $localeName = empty($request->locale) || $request->locale === 'ua' ? 'name_full' : 'name_full_rus';

        return [
            'value' => $this->id,
            'name' => $this->$localeName,
        ];
    }

}
