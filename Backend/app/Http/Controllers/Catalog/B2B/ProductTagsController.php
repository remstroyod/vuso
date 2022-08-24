<?php

namespace Backend\Http\Controllers\Catalog\B2B;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Catalog\StoreCatalogProductTagsHandler;
use Backend\Models\Catalog\Product;
use Backend\Models\Pages;
use Backend\Models\Tag;
use Illuminate\Http\Request;

class ProductTagsController extends Controller
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
    public function index(Pages $pages, Product $product)
    {

        $model = $pages->findOrFail('b2b');

        return view('pages.catalog.products.tags', [
            'model' => $product,
            'page'  => $model,
            'tags'  => Tag::whereProducts()->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreCatalogProductTagsHandler $handler, Product $product)
    {

        if ($product = $handler->process($request, $product)) :

            return redirect()->route('b2b.products.edit', ['product' => $product])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
