<?php

namespace Backend\Modules\EDocuments\Http\Resources;

use Backend\Modules\EDocuments\Enums\EDocumentsDocsExtensionEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class EDocumentsDocsSystemResourse extends JsonResource
{
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'type' => $this->document->name,
            'name' => $this->name,
            'description' => $this->description,
            'extension' => EDocumentsDocsExtensionEnum::type($this->extension),
        ];
    }

    /**
     * @param $request
     * @return string[]
     */
    public function with($request){
        return [
            'version'       => '1.0',
            'url'           => 'https://vuso.ua'
        ];
    }
}
