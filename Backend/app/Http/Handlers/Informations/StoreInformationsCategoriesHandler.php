<?php

namespace Backend\Http\Handlers\Informations;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Informations\InformationsCategoriesRequest;
use Backend\Models\Informations\Categories;
use Backend\Models\Pages;
use Illuminate\Support\Facades\Gate;

class StoreInformationsCategoriesHandler extends BaseHandler
{

    /**
     * @param AwardsRequest $request
     * @param Awards|null $awards
     * @return Awards|null
     */
    public function process(InformationsCategoriesRequest $request, Categories $categories = null): ?Categories
    {

        try {

            if (!$categories) :
                $categories = new Categories();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('informations'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $categories->fill($request->all());

            $categories->save($request->all());

            return $categories;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
