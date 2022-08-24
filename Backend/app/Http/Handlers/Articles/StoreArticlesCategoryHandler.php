<?php

namespace Backend\Http\Handlers\Articles;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Articles\CategoryRequest;
use Backend\Models\Articles\Articles;
use Backend\Models\Articles\Categories;
use Illuminate\Support\Facades\Gate;

class StoreArticlesCategoryHandler extends BaseHandler
{

    /**
     * @param CategoryRequest $request
     * @param Categories|null $categories
     * @return Categories|null
     */
    public function process(CategoryRequest $request, Categories $categories = null): ?Categories
    {

        try {

            if (!$categories) :
                $categories = new Categories();
                $response = Gate::inspect('create', Articles::class);
            else:
                $response = Gate::inspect('update', Articles::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $categories->fill($request->all());

            $categories->save($request->all());

            return $categories;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
