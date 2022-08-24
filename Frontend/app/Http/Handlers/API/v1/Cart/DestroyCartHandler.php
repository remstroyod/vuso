<?php

namespace Frontend\Http\Handlers\API\v1\Cart;

use Backend\Http\Handlers\BaseHandler;
use Frontend\Models\Catalog\Product;
use Frontend\Models\Profile\User;
use Illuminate\Http\Request;

class DestroyCartHandler extends BaseHandler
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


            \Cart::session($user->id)->remove($product);

            if( \Cart::session($user->id)->isEmpty() )
            {
                \Cart::session($user->id)->clearCartConditions(); // Clear all promocodes
            }

            return true;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }


    }

}
