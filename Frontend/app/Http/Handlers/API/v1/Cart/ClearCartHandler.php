<?php

namespace Frontend\Http\Handlers\API\v1\Cart;

use Backend\Http\Handlers\BaseHandler;
use Frontend\Models\Catalog\Product;
use Frontend\Models\Profile\User;
use Illuminate\Http\Request;

class ClearCartHandler extends BaseHandler
{

    /**
     * @param Request $request
     * @param $product
     * @return mixed
     */
    public function process(Request $request)
    {

        try {

            $user = $request->user();

            if(empty($user))
            {

                $this->setErrors('User is not Empty');
                return null;

            }

            \Cart::session($user->id)->clear();

            return true;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }


    }

}
