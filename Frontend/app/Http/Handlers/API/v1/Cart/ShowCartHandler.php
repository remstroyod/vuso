<?php

namespace Frontend\Http\Handlers\API\v1\Cart;

use Backend\Http\Handlers\BaseHandler;
use Frontend\Http\Resources\API\v1\Cart\CartResource;
use Illuminate\Http\Request;

class ShowCartHandler extends BaseHandler
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

            return CartResource::collection(\Cart::session($user->id)->getContent());

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }


    }

}
