<?php

namespace Frontend\Http\Handlers\API\v1\Cart;

use Backend\Http\Handlers\BaseHandler;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Frontend\Http\Resources\API\v1\Cart\CartResource;
use Illuminate\Http\Request;

class UpdateCartHandler extends BaseHandler
{

    /**
     * @param Request $request
     * @param $product
     * @return mixed
     */
    public function process(Request $request, $product)
    {

        try {

            $user = $request->user();

            if(empty($user))
            {

                $this->setErrors('User is not Empty');
                return null;

            }

            $itemCart = \Cart::session($user->id)->get($product);
            if( !$itemCart )
            {
                $this->setErrors('Item Cart Not Found');
                return null;
            }

            $fields = $request->only([
                'id',
                'name',
                'price',
                'quantity',
            ]);

            if( $request->has('document_id') )
            {
                $attributes = $itemCart->attributes->toArray();
                $fields['attributes'] = $attributes;
                $fields['attributes']['document_id'] = (int) $request->input('document_id');

                /**
                 * Update Document
                 */
                EdocumentUser::where('id', $request->input('document_id'))->update([
                    'total' => $itemCart->getPriceWithConditions(),
                    'subtotal' => $itemCart->price,
                ]);

            }
            if( $request->has('widget_state') )
            {
                $attributes = $itemCart->attributes->toArray();
                $fields['attributes'] = $attributes;
                $fields['attributes']['widget_state'] = $request->input('widget_state');
            }

            \Cart::session($user->id)->update($product, $fields);

            return new CartResource(\Cart::get($product));

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
