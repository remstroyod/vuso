<?php

namespace Backend\Http\Handlers\Attachfaq;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Attachfaq\AttachFaqRequest;
use Backend\Models\Catalog\Category;
use Backend\Models\Pages;
use Illuminate\Support\Facades\Gate;

class StoreAttachFaqCatalogControllerHandler extends BaseHandler
{

    /**
     * @param AttachFaqRequest $request
     * @param Pages|null $page
     * @return Pages|null
     */
    public function process(AttachFaqRequest $request, Category $category = null): ?Category
    {

        try {

            if (!$category) :
                $category = new Category();
                $response = Gate::inspect('create', Category::class);
            else:
                $response = Gate::inspect('update', Category::class);
            endif;

            if (!$response->allowed())
            {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            /**
             * Faqs List
             */
            $faqs = $request->has('faqs') ? $request->input('faqs') : [];
            $this->storePagesRelatedData($category, $faqs);

            return $category;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

    /**
     * @param Pages $pages
     * @param array $tags
     * @return void
     */
    private function storePagesRelatedData(Category $category, array $tags)
    {

        $arr = [];
        foreach ( $tags as $tag ) :

            $arr[$tag] = [
                'pages_page' => $category->id,
                'model' => 'catalog.category'
            ];

        endforeach;

        $category->faqs()->sync($arr);

    }

}
