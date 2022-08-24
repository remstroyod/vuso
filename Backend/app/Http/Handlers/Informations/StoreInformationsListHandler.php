<?php

namespace Backend\Http\Handlers\Informations;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Informations\InformationsListRequest;
use Backend\Models\Informations\Informations;
use Backend\Models\Pages;
use Backend\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreInformationsListHandler extends BaseHandler
{

    use FileUploadTrait;

    /**
     * @param AwardsRequest $request
     * @param Awards|null $awards
     * @return Awards|null
     */
    public function process(InformationsListRequest $request, Informations $informations = null): ?Informations
    {

        try {

            if (!$informations) :
                $informations = new Informations();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('informations'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $informations->fill($request->all());

            $informations->save($request->all());

            return $informations;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
