<?php

namespace Backend\Http\Handlers\Catalog;

use Backend\Enums\TagsEnum;
use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Catalog\CatalogCategoryRequest;
use Backend\Models\Catalog\Category;
use Backend\Models\Catalog\Product;
use Backend\Models\Tag;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoreCatalogProductTagsHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param CatalogCategoryRequest $request
     * @param Category|null $category
     * @return Category|null
     */
    public function process(Request $request, Product $product = null): ?Product
    {

        try {

            if (!$product) :
                $product = new Product();
                $response = Gate::inspect('create', Product::class);
            else:
                $response = Gate::inspect('update', Product::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            /**
             * Tags
             */
            $tags = $this->tags($product, $request->tag);
            $product->tags()->sync($tags);



            return $product;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }


    /**
     * @param array $tags
     * @return array
     */
    public function tags($model, array $tags)
    {

        $arr = [];

        if( $tags )
        {

            foreach ( $tags as $tag )
            {
                $tg = Tag::where('name', $tag)->orWhere('id', $tag)->first();

                if( !$tg )
                {

                    $tg = Tag::create([
                        'name' => $tag,
                        'type' => TagsEnum::product,
                    ]);

                }

                $arr[$tg->id] = [
                    'pages_id' => $model->id,
                ];

            }

        }

        return $arr;

    }


}
