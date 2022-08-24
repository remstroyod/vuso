<?php

namespace Backend\Http\Handlers\Catalog;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Catalog\CatalogCategoryRequest;
use Backend\Http\Requests\Catalog\CatalogProductRequest;
use Backend\Models\Catalog\Category;
use Backend\Models\Catalog\Product;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Gate;

class StoreCatalogProductHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param CatalogCategoryRequest $request
     * @param Category|null $category
     * @return Category|null
     */
    public function process(CatalogProductRequest $request, Product $product = null): ?Product
    {

        try {

            if (!$product) :
                $product = new Product();
                $response = Gate::inspect('create', Product::class);
            else:
                $response = Gate::inspect('update', Product::class);
            endif;

            if (!$response->allowed())
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));

            $product->fill($request->all());
            $product->save($request->all());

            $product->categories()->sync($request->input('category'));
            $product->relevant()->sync($request->input('relevant', []));

            /**
             * Upload Image
             */
            if( $request->hasFile('image') ) :
                $product->update(['image' => $this->imageUpload($product, 'catalog/products')]);
            endif;

            /**
             * Remove Image
             */
            if ($request->input('flush_image')) :

                $this->imageRemove($product, 'catalog/products');
                $product->update(['image' => null]);

            endif;

            return $product;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
