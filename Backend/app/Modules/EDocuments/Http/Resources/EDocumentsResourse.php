<?php

namespace Backend\Modules\EDocuments\Http\Resources;

use Backend\Modules\EDocuments\Enums\EDocumentsDocsExtensionEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class EDocumentsResourse extends JsonResource
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
            'id'    => $this->id,
            'document' => $this->document->name,
            'user' => $this->user_id,
            'storage' => $this->storage,
            'folder' => $this->folder,
            'filename' => $this->filename,
            'extension' => EDocumentsDocsExtensionEnum::$name[$this->extension],
            'url' => $this->url,
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
