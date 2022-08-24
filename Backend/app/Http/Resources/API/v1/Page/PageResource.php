<?php

namespace Backend\Http\Resources\API\v1\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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

        $lang = ($request->has('lang')) ? $request->lang : config('app.fallback_locale');

        return [
            'id' => $this->id,
            'slug' => $this->page,
            'name' => $this->getTranslation('name', $lang),
            'scenario' => $this->getTranslation('scenario', $lang),
        ];
    }

}
