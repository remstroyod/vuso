<?php

namespace Backend\Modules\EDocuments\Http\Handlers;

use Backend\Http\Handlers\BaseHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsRequest;
use Backend\Modules\EDocuments\Models\EDocuments;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class StoreEDocumentsHandler extends BaseHandler
{

    /**
     * @param EDocumentsRequest $request
     * @param EDocuments|null $document
     * @return EDocuments|null
     */
    public function process(EDocumentsRequest $request, EDocuments $document = null): ?EDocuments
    {

        try {

            $operations = 'create';

            if (!$document) :
                $document = new EDocuments();
                $response = Gate::inspect('create', EDocuments::class);
            else:
                $response = Gate::inspect('update', EDocuments::class);
                $operations = 'update';
            endif;

            if (!$response->allowed())
            {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            if ($operations === 'create')
            {
                Storage::disk('google')->createDir($request->name);
            }

            $document->fill($request->all());

            $document->save($request->all());

            return $document;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
