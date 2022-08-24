<?php

namespace Backend\Http\Controllers\Catalog;

use Backend\Enums\CatalogEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Catalog\StoreCatalogProductHandler;
use Backend\Http\Requests\Catalog\CatalogProductRequest;
use Backend\Models\Catalog\Category;
use Backend\Models\Catalog\Contragents;
use Backend\Models\Catalog\Product;
use Backend\Models\Pages;
use Backend\Modules\PayHub\Models\PayHubSystem;

class ProductController extends Controller
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
    public function index(Pages $pages)
    {
        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.products.index', [
            'model' => $model,
            'items' => Product::whereDefault()->paginate(20),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pages $pages, Product $product, Category $categories)
    {

        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.products.form', [
            'model'         => $product,
            'page'          => $model,
            'categories'    => $categories->whereDefault()->get(),
            'type'          => CatalogEnum::default,
            'products'      => $product->whereDefault()->get(),
            'payhub'        => PayHubSystem::all(),
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

        if ($product = $handler->process($request)) :

            return redirect()->route('catalog.products.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages, Product $product, Category $categories)
    {

        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.products.form', [
            'model'         => $product,
            'page'          => $model,
            'categories'    => $categories->whereDefault()->get(),
            'type'          => CatalogEnum::default,
            'products'      => $product->whereDefault()->whereNotCurrent($product->id)->get(),
            'payhub'        => PayHubSystem::all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogProductRequest $request, StoreCatalogProductHandler $handler, Product $product)
    {

        if ($product = $handler->process($request, $product)) :

            return redirect()->route('catalog.products.edit', $product)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if ($product->delete()) :

            return redirect()->route('catalog.products.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Contragents $contragents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Pages $pages, Product $product)
    {

        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.products.seo', [
            'model' => $product,
            'page' => $model,
        ]);

    }
}
