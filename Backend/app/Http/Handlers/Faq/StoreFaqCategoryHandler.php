<?php

namespace Backend\Http\Handlers\Faq;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Faq\CategoryRequest;
use Backend\Models\Faq\Categories;
use Backend\Models\Faq\Faq;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreFaqCategoryHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param ArticlesRequest $request
     * @param Articles|null $articles
     * @return Articles|null
     */
    public function process(CategoryRequest $request, Categories $categories = null): ?Categories
    {

        try {

            if (!$categories) :
                $categories = new Categories();
                $response = Gate::inspect('create', Faq::class);
            else:
                $response = Gate::inspect('update', Faq::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $categories->fill($request->all());

            $categories->save($request->all());

            /**
             * Upload Image
             */
            if( $request->hasFile('image') ) :
                $categories->update(['image' => $this->imageUpload($categories, 'faq/categories')]);
            endif;

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($categories, 'faq/categories');
                $categories->update(['image' => null]);

            endif;

            return $categories;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
