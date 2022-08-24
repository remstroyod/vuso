<?php

namespace Backend\Http\Handlers\Catalog;

use Backend\Http\Handlers\BaseHandler;
use Backend\Models\Catalog\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoreCatalogEdocumentsHandler extends BaseHandler
{

    /**
     * @param Request $request
     * @param Product|null $product
     * @return Product|null
     */
    public function process(Request $request, Product $product  = null): ?Product
    {

        try {

            $response = Gate::inspect('update', Product::class);

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $this->storeEdocumentsRelatedData($product, $request->input('document'));

            return $product;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

    private function storeEdocumentsRelatedData(Product $product, array $documents)
    {

        $arr = [];
        foreach ( $documents as $key => $value ) :

            if( $value <> 0 ) :
                $arr[] = [
                    'document_id' => $value,
                    'type_id' => $key
                ];
            endif;

        endforeach;

        $product->documents()->sync($arr);

    }

}
