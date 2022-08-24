<?php

namespace Frontend\Http\Controllers\API\v1\Cart;

use Frontend\Http\Controllers\Controller;
use Frontend\Http\Handlers\API\v1\Cart\ClearCartHandler;
use Frontend\Http\Handlers\API\v1\Cart\DestroyCartHandler;
use Frontend\Http\Handlers\API\v1\Cart\DestroyAllCartHandler;
use Frontend\Http\Handlers\API\v1\Cart\ShowCartHandler;
use Frontend\Http\Handlers\API\v1\Cart\StoreCartHandler;
use Frontend\Http\Handlers\API\v1\Cart\UpdateCartHandler;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, StoreCartHandler $handler, $product)
    {
        
        if ($product = $handler->process($request, $product)) :

            return response()->json([
                'item' => $product->id,
                'status' => true,
                'message' => 'Product Added to Cart'
            ], 200);

        endif;

        return response()->json([
            'data' => [],
            'status' => false,
            'message' => $handler->getErrors()
        ], 422);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, ShowCartHandler $handler)
    {

        if ($product = $handler->process($request)) :

            return response()->json([
                'data' => $product,
                'status' => true,
                'message' => 'Show Cart Item'
            ], 200);

        endif;

        return response()->json([
            'data' => [],
            'status' => false,
            'message' => $handler->getErrors()
        ], 422);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, UpdateCartHandler $handler, $product)
    {

        if ($product = $handler->process($request, $product)) :

            return response()->json([
                'data' => $product,
                'status' => true,
                'message' => 'Product Updated in Cart'
            ], 200);

        endif;

        return response()->json([
            'data' => [],
            'status' => false,
            'message' => $handler->getErrors()
        ], 422);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, DestroyCartHandler $handler)
    {

        $item = $request->item;
        
        if ($product = $handler->process($request, $item)) :

            return response()->json([
                'data' => $product,
                'status' => true,
                'message' => 'Product Remove Cart'
            ], 200);

        endif;

        return response()->json([
            'data' => [],
            'status' => false,
            'message' => $handler->getErrors()
        ], 422);

    }

    /**
     * Remove all resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request, DestroyAllCartHandler $handler)
    {

        if ($handler->process($request)) :

            return response()->json([
                'status' => true,
                'message' => 'Product Remove Cart'
            ], 200);

        endif;

        return response()->json([
            'data' => [],
            'status' => false,
            'message' => $handler->getErrors()
        ], 422);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartTotal(Request $request)
    {

        if($request->missing('user'))
        {

            return response()->json([
                'data' => [],
                'status' => false,
                'message' => 'User is Not Empty'
            ], 422);

        }

        return response()->json([
            'data' => \Cart::session($request->user)->getTotal(),
            'status' => true,
            'message' => 'Total Cart'
        ], 200);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartSubTotal(Request $request)
    {

        if($request->missing('user'))
        {

            return response()->json([
                'data' => [],
                'status' => false,
                'message' => 'User is Not Empty'
            ], 422);

        }

        return response()->json([
            'data' => \Cart::session($request->user)->getSubTotal(),
            'status' => true,
            'message' => 'SubTotal Cart'
        ], 200);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartQuantity(Request $request)
    {

        if($request->missing('user'))
        {

            return response()->json([
                'data' => [],
                'status' => false,
                'message' => 'User is Not Empty'
            ], 422);

        }

        return response()->json([
            'data' => \Cart::session($request->user)->getTotalQuantity(),
            'status' => true,
            'message' => 'SubTotal Cart'
        ], 200);


    }

    /**
     * @param Request $request
     * @param ClearCartHandler $handler
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear(Request $request, ClearCartHandler $handler)
    {

        if ($product = $handler->process($request)) :

            return response()->json([
                'data' => [],
                'status' => true,
                'message' => 'Cart Clear Success'
            ], 200);

        endif;

        return response()->json([
            'data' => [],
            'status' => false,
            'message' => $handler->getErrors()
        ], 422);

    }

}
