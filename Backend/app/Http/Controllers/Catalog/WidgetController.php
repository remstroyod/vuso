<?php

namespace Backend\Http\Controllers\Catalog;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Catalog\StoreCatalogWidgetHandler;
use Backend\Models\Catalog\Product;
use Backend\Models\Pages;
use Illuminate\Http\Request;

class WidgetController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:catalog_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pages $pages, Product $product)
    {

        $pages = $pages->findOrFail('catalog');

        return view('pages.catalog.widget.form', [
            'page' => $pages,
            'product' => $product,
        ]);

    }

}
