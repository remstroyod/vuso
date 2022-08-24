<?php

namespace Frontend\Http\Handlers\API\v1\Cart;

use Backend\Http\Handlers\BaseHandler;
use Darryldecode\Cart\CartCondition;
use Frontend\Http\Resources\API\v1\Cart\CartResource;
use Frontend\Models\Catalog\Product;
use Frontend\Models\Profile\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreCartHandler extends BaseHandler
{

    /**
     * @param Request $request
     * @param $product
     * @return mixed
     */
    public function process(Request $request, $product)
    {

        try {

            $product = Product::findOrFail($product);
            $user = $request->user();
            $id_unique_product = Str::random(32);

            /**
             * if has Cart Promocode
             */
            $conditions = [];
            $cartConditions = \Cart::session($user->id)->getConditions();

            if( count($cartConditions) )
            {

                $arrCond = [];

                foreach ( $cartConditions as $item )
                {

                    $arrCond['name'] = $item->getName();
                    $arrCond['type'] = $item->getType();
                    $arrCond['value'] = $item->getValue();

                }

                $conditions = new CartCondition($arrCond);
            }

            \Cart::session($user->id);

            $cartItem = \Cart::add([
                'id'            => $id_unique_product,
                'name'          => $product->name,
                'price'         => $request->input('price'),
                'quantity'      => 1,
                'attributes'    => [
                    'id_product'    => $product->id,
                    'document_id'   => $request->input('document_id'),
                    'widget_state'  => $request->input('widget_state'),
                    'item_info'     => $request->input('display_info') ?? [],
                ],
                'conditions' => $conditions,
            ]);

            return new CartResource(\Cart::session($user->id)->get($id_unique_product));

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
