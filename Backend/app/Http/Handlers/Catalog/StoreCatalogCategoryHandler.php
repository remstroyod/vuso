<?php

namespace Backend\Http\Handlers\Catalog;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Catalog\CatalogCategoryRequest;
use Backend\Models\Catalog\Category;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreCatalogCategoryHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param CatalogCategoryRequest $request
     * @param Category|null $category
     * @return Category|null
     */
    public function process(CatalogCategoryRequest $request, Category $category = null): ?Category
    {

        try {

            if (!$category) :
                $category = new Category();
                $response = Gate::inspect('create', Category::class);
            else:
                $response = Gate::inspect('update', Category::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $category->fill($request->all());

            $category->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') )
            {

                $category->update(['image' => $this->imageUpload($category, 'catalog/category')]);

            }

            /**
             * Upload Icon
             */
            if( $request->hasFile('icon_image') )
            {

                $category->update(['icon_image' => $this->imageUpload($category, 'catalog/category', 'icon_image')]);

            }

            /**
             * Remove Image
             */
            if ($request->input('flush_image'))
            {

                $this->imageRemove($category, 'catalog/category');
                $category->update(['image' => null]);

            }
            if ($request->input('flush_icon'))
            {

                $this->imageRemove($category, 'catalog/category', 'flush_image');
                $category->update(['icon_image' => null]);

            }

            return $category;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
