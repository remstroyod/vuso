<?php

namespace Backend\Modules\EDocuments\Http\Handlers;

use Backend\Http\Handlers\BaseHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsImagesRequest;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Modules\EDocuments\Models\EDocumentsImages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreEDocumentsImagesHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param EDocumentsImagesRequest $request
     * @param EDocumentsDocs $document
     * @param EDocumentsImages|null $image
     * @return EDocumentsImages|null
     */
    public function process(EDocumentsImagesRequest $request, EDocumentsDocs $document, EDocumentsImages $image = null): ?EDocumentsImages
    {

        try {

            if (!$image) :
                $image = new EDocumentsImages();
                $response = Gate::inspect('create', EDocumentsImages::class);
            else:
                $response = Gate::inspect('update', EDocumentsImages::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $image->document()->associate($document);
            $image->fill($request->all());
            $image->save();

            /**
             * Upload Image
             */
            if( $request->hasFile('image') )
            {
                $image->update([
                    'image' => $this->imageUpload($image, 'modules/edocuments/images')
                ]);
            }

            /**
             * Remove File
             */
            if ($request->input('flush_image'))
            {

                $this->imageRemove($image, 'modules/edocuments/images');
                $image->update(['image' => null]);

            }

            return $image;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
