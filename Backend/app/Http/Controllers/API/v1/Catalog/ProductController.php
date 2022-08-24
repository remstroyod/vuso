<?php

namespace Backend\Http\Controllers\API\v1\Catalog;

use Backend\Http\Handlers\API\v1\Catalog\StoreProductHandler;
use Backend\Http\Resources\API\v1\Catalog\ProductResource;
use Backend\Models\Catalog\Product;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @return void
     */
    public function index(Request $request)
    {

        $product = Product::paginate(10)->appends(request()->input());

        if(!$product) {

            return response()->json([
                'data' => [],
                'message' => 'Products Not Found'
            ], 403);
        }

        return ProductResource::collection($product);

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {

        if(!$product) {

            return response()->json([
                'data' => [],
                'message' => 'Product Not Found'
            ], 403);
        }

        return new ProductResource($product);

    }

    /**
     * @param Request $request
     * @param StoreProductHandler $handler
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, StoreProductHandler $handler, Product $product)
    {

        if ($product = $handler->process($request, $product)) :

            return response()->json([
                'data' => $product,
                'status' => 'success',
                'message' => 'Product Save Success'
            ], 200);

        endif;

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => $handler->getErrors()
        ], 403);

    }

}
