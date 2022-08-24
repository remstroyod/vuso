<?php

namespace Backend\Http\Controllers\Catalog\B2B;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Catalog\StoreCatalogProductHandler;
use Backend\Http\Handlers\Catalog\StoreCatalogProductTagsHandler;
use Backend\Http\Requests\Catalog\CatalogProductRequest;
use Backend\Models\Catalog\Category;
use Backend\Models\Catalog\Product;
use Backend\Models\Pages;
use Backend\Models\Tag;
use Illuminate\Http\Request;

class ProductBuilderController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:catalog_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages, Product $product, Category $categories)
    {

        $model = $pages->findOrFail('b2b');

        return view('pages.catalog.products.builder', [
            'model' => $product,
            'page'  => $model,
            'categories' => $categories->whereB2B()->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogProductRequest $request, StoreCatalogProductHandler $handler, Product $product)
    {

        if ($product = $handler->process($request, $product)) :

            return redirect()->route('b2b.products.builder', ['product' => $product])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
