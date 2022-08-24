<?php
namespace Frontend\Http\Controllers\Catalog;

use Frontend\Http\Controllers\Controller;
use Frontend\Models\Catalog\Category;
use Frontend\Models\Catalog\Contragents;
use Frontend\Models\Catalog\Product;
use Frontend\Models\Pages;
use Illuminate\Support\Facades\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.index', [
            'page'          => $model,
            'contragents'   => Contragents::whereDefault()->get(),
            'categories'    => Category::whereDefault()->whereAttach()->get(),
            'faqs'          => $model->faqs,
            'blocks'        => $model->blocks,
        ]);

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @param Contragents $contragents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contragents(Request $request, Pages $pages, Contragents $contragents)
    {

        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.index', [
            'page'          => $model,
            'contragents'   => Contragents::whereDefault()->get(),
            'categories'    => Category::whereDefault()->whereAttach($contragents)->get(),
            'faqs'          => $model->faqs,
            'blocks'        => $model->blocks,
        ]);

    }

    /**
     * @param Request $request
     * @param Contragents $contragents
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(Request $request, Contragents $contragents, Category $category)
    {

        return view('pages.catalog.category', [
            'page'      => $category,
            'faqs'      => $category->faqs,
            'products'  => $category->products->all(),
            'blocks'    => $category->blocks,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Contragents $contragents, Category $category, Product $product)
    {

        if(!$product->is_active)
        {
            abort(444);
        }

        return view('pages.catalog.product', [
            'page' => $product,
        ]);

    }

}
