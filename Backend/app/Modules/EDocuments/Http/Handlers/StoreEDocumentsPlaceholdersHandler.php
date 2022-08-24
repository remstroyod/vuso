<?php

namespace Backend\Modules\EDocuments\Http\Handlers;

use Backend\Http\Handlers\BaseHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsPlaceholdersRequest;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Illuminate\Support\Facades\Gate;

class StoreEDocumentsPlaceholdersHandler extends BaseHandler
{

    /**
     * @param EDocumentsPlaceholdersRequest $request
     * @param EDocumentsPlaceholders|null $placeholder
     * @return EDocumentsPlaceholders|null
     */
    public function process(EDocumentsPlaceholdersRequest $request, EDocumentsPlaceholders $placeholder = null): ?EDocumentsPlaceholders
    {

        try {

            if (!$placeholder) :
                $placeholder = new EDocumentsPlaceholders();
                $response = Gate::inspect('create', EDocumentsPlaceholders::class);
            else:
                $response = Gate::inspect('update', EDocumentsPlaceholders::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $placeholder->fill($request->all());

            $placeholder->save($request->all());

            return $placeholder;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
