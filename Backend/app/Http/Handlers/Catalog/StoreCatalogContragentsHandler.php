<?php

namespace Backend\Http\Handlers\Catalog;

use Backend\Events\Catalog\ContragentsEvent;
use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Catalog\CatalogContragentsRequest;
use Backend\Models\Catalog\Contragents;
use Illuminate\Support\Facades\Gate;

class StoreCatalogContragentsHandler extends BaseHandler
{

    /**
     * @param CatalogContragentsRequest $request
     * @param Contragents|null $contragents
     * @return Contragents|null
     */
    public function process(CatalogContragentsRequest $request, Contragents $contragents = null): ?Contragents
    {

        try {

            if (!$contragents) :
                $contragents = new Contragents();
                $response = Gate::inspect('create', Contragents::class);
            else:
                $response = Gate::inspect('update', Contragents::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $contragents->fill($request->all());

            $contragents->save($request->all());

            event(new ContragentsEvent($contragents));

            return $contragents;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
