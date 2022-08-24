<?php

namespace Backend\Http\Handlers\Sales;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Sales\SalesCategoriesRequest;
use Backend\Models\Sales\Categories;
use Backend\Models\Sales\Sales;
use Illuminate\Support\Facades\Gate;

class StoreSalesCategoriesHandler extends BaseHandler
{

    /**
     * @param SalesCategoriesRequest $request
     * @param Categories|null $categories
     * @return Categories|null
     */
    public function process(SalesCategoriesRequest $request, Categories $categories = null): ?Categories
    {

        try {

            if (!$categories) :
                $categories = new Categories();
                $response = Gate::inspect('create', Sales::class);
            else:
                $response = Gate::inspect('update', Sales::class);
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
