<?php

namespace Backend\Http\Handlers\API\v1\Catalog;

use Backend\Http\Handlers\BaseHandler;
use Backend\Models\Catalog\Product;
use Illuminate\Http\Request;

class StoreProductHandler extends BaseHandler
{

    /**
     * @param Request $request
     * @param $product
     * @return mixed
     */
    public function process(Request $request, Product $product = NULL): ?Product
    {

        try {

            if (!$product) $product = new Product();

            $product->fill($request->all());

            if( $request->has('lang') && $request->has('scenario') )
            {
                $product->setTranslation('scenario', $request->lang, $request->scenario);
            }

            $product->save($request->all());

            return $product;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
