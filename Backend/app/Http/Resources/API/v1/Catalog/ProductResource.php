<?php

namespace Backend\Http\Resources\API\v1\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        $seo = $this->seo;

        if( $seo )
        {

            $seo = [
                'h1' => $seo->h1 ? $seo->getTranslation('h1', $lang) : null,
                'title' => $seo->title ? $seo->getTranslation('title', $lang) : null,
                'description' => $seo->description ? $seo->getTranslation('description', $lang) : null,
                'keyword' => $seo->keyword ? $seo->getTranslation('keyword', $lang) : null,
                'robots' => $seo->robots,
                'canonical' => $seo->canonical,
                'slug' => $seo->slug,
                'text' => $seo->text ? $seo->getTranslation('text', $lang) : null,
                'text_active' => $seo->text_active,
                'image' => $seo->image,
            ];
        }

        $relevant = [];
        $relevant_products = $this->relevant;
        if ( $relevant_products )
        {
            foreach ( $relevant_products as $item )
            {
                $relevant[] = new ProductResource($item);
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $lang),
            'short_name' => $this->getTranslation('short_name', $lang),
            'description' => $this->getTranslation('description', $lang),
            'excerpt' => $this->getTranslation('excerpt', $lang),
            'image' => $this->image,
            'slug' => $this->slug,
            'content' => $this->getTranslation('content', $lang),
            'seo' => $seo,
            'scenario' => $this->getTranslation('scenario', $lang),
            'token' => $this->token,
            'relevant' => $relevant,
        ];
    }

}
