<?php

namespace Backend\Modules\EDocuments\Http\Handlers;

use Backend\Http\Handlers\BaseHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsDocsRequest;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreEDocumentsDocsHandler extends BaseHandler
{

    use FileUploadTrait;

    /**
     * @param EDocumentsDocsRequest $request
     * @param EDocumentsDocs|null $document
     * @return EDocumentsDocs|null
     */
    public function process(EDocumentsDocsRequest $request, EDocumentsDocs $document = null): ?EDocumentsDocs
    {

        try {

            if (!$document) :
                $document = new EDocumentsDocs();
                $response = Gate::inspect('create', EDocumentsDocs::class);
            else:
                $response = Gate::inspect('update', EDocumentsDocs::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $document->fill($request->all());

            $document->save($request->all());

            /**
             * Upload File
             */
            if( $request->hasFile('input_file') ) {
                $uploader = $this->fileUpload($document, 'modules/edocuments/docx', true);
                $document->update([
                    'file' => $uploader->name,
                    'filename' => $uploader->filename
                ]);
            }

            /**
             * Remove File
             */
            if ($request->input('flush_file')) :

                $this->fileRemove($document, 'modules/edocuments/docx');
                $document->update(['file' => null]);

            endif;

            return $document;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
