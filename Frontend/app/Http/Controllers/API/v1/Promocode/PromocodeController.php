<?php

namespace Frontend\Http\Controllers\API\v1\Promocode;

use Backend\Enums\PromocodeTypeEnum;
use Darryldecode\Cart\CartCondition;
use Frontend\Http\Controllers\Controller;
use Frontend\Http\Resources\API\v1\Cart\CartResource;
use Frontend\Http\Resources\API\v1\Promocode\PromocodeApplyResource;
use Frontend\Http\Resources\API\v1\Promocode\PromocodeResource;
use Backend\Models\Ecommerce\Promocode;
use Gabievi\Promocodes\Facades\Promocodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromocodeController extends Controller
{

    /**
     * @return void
     */
    public function index(Request $request)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valid(Request $request)
    {

        $promocode = Promocode::where('code', $request->code)->first();

        if( !$promocode )
        {
            return response()->json([
                'status' => false,
                'message' => __( 'Промокод не найден' )
            ], 422);
        }

        if( Promocodes::check($request->code) )
        {

            return response()->json([
                'status' => true,
                'data' => new PromocodeResource($promocode),
                'message' => __( 'Промокод действительный' )
            ], 200);

        }

        return response()->json([
            'status' => false,
            'message' => __( 'Промокод не действительный' )
        ], 422);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(Request $request)
    {

        $user = $request->user();

        if( empty($user) )
        {
            return response()->json([
                'status' => false,
                'message' => __( 'Не передан обязательный параметр user' )
            ], 422);

        }

        $returnOnlyProduct = [];

        $validPromocode = $this->valid($request);

        if( $validPromocode->isSuccessful() )
        {

            $promocode = $validPromocode->getOriginalContent()['data']; // Get Information Promocode

            $cartCollection = \Cart::session($user->id)->getContent(); //Get Cart by User

            if( !$cartCollection->isEmpty() )
            {

                foreach ( $cartCollection as $item )
                {

                    \Cart::session($user->id)->clearItemConditions($item->id); // Clear otcher promocodes

                    $validProduct = $this->isProduct($promocode, $item->attributes->id_product); // is Only Products

                    if( $validProduct )
                    {

                        $coupon = new CartCondition([
                            'name' => $promocode->code,
                            'type' => $promocode->type == PromocodeTypeEnum::promocode ? 'promocode' : 'coupon',
                            'value' => $this->formatReward($promocode),
                        ]);

                        \Cart::session($user->id)->addItemCondition($item->id, $coupon);

                        /**
                         * Apply Promocode
                         */
                        //Auth::loginUsingId($user->id);
                        Promocodes::apply($promocode->code);

                        /**
                         * is return only product ID
                         */
                        if( $request->has('product') && $item->attributes->id_product == $request->input('product') )
                        {
                            $returnOnlyProduct = $item->id;
                        }

                    }

                }

                return response()->json([
                    'status' => true,
                    'message' => $returnOnlyProduct ? new CartResource(\Cart::session($user->id)->get($returnOnlyProduct)) : CartResource::collection($cartCollection),
                ], 200);

            }

            return response()->json([
                'status' => false,
                'message' => __( 'Корзина пуста' ),
            ], 422);

        }

        return response()->json([
            'status' => false,
            'message' => $validPromocode->getOriginalContent()
        ], 422);

    }

        /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Request $request)
    {

        $user = $request->user();

        if( empty($user) )
        {
            return response()->json([
                'status' => false,
                'message' => __( 'Не передан обязательный параметр user' )
            ], 422);

        }

        $cartCollection = \Cart::session($user->id)->getContent(); //Get Cart by User

        if( !$cartCollection->isEmpty() )
        {

            foreach ( $cartCollection as $item )
            {

                \Cart::session($user->id)->clearItemConditions($item->id); // Clear otcher promocodes

            }

            return response()->json([
                'status' => true,
                'message' => __( 'Промокод отменён' ),
            ], 200);

        }

        return response()->json([
            'status' => false,
            'message' => __( 'Корзина пуста' ),
        ], 422);

    }

    /**
     * @param $promocode
     * @return string
     */
    protected function formatReward($promocode): string
    {

        $value = '-';
        $value .= $promocode->reward;
        $value .= ($promocode->data->reward_type == 'percent') ? '%' : '';

        return $value;

    }

    /**
     * @param $promocode
     * @param $product
     * @return bool
     */
    protected function isProduct($promocode, $product): bool
    {

        $products = $promocode->products;

        if( $products->count() )
        {
            if( $product = $products->where('id', $product)->first() )
            {
                return true;
            }

            return false;

        }

        return true;

    }


}
