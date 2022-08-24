<?php
namespace Frontend\Http\Controllers\Catalog;

use Frontend\Http\Controllers\Controller;
use Frontend\Models\Catalog\Category;
use Frontend\Models\Catalog\Contragents;
use Frontend\Models\Catalog\Product;
use Frontend\Models\Pages;
use Frontend\Models\Tag;
use Illuminate\Support\Facades\Request;

class CatalogB2BController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pages $pages)
    {

        $model = $pages->findOrFail('b2b');

        $products = new Product();

        $items = $products->whereB2B()->whereTags(app()->request->tags)->paginate(4);

        if (app()->request->ajax())
            return view('partials.loop.catalog-b2b-ajax', compact('items'));

        return view('pages.catalog.b2b.index', [
            'page'              => $model,
            'contragents'       => Contragents::whereB2B()->get(),
            'categories'        => Category::whereB2B()->get(),
            'faqs'              => $model->faqs,
            'blocks'            => $model->blocks,
            'tags'              => $products->getTagsProducts(),
            'products'          => $items,
            'contragentCatalog' => Contragents::whereDefault()->whereAttach()->first(),
        ]);

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @param Contragents $contragents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function contragents(
        Request $request,
        Pages $pages,
        Contragents $contragents,
        Tag $tags,
        Product $product)
    {

        $model = $pages->findOrFail('b2b');

        $items = $product->whereB2B()->whereCategories($contragents)->paginate(3);

        if (app()->request->ajax())
            return view('partials.loop.catalog-b2b-ajax', compact('items'));

        return view('pages.catalog.b2b.index', [
            'page'          => $model,
            'contragents'   => $contragents::query()->whereB2B()->get(),
            'categories'    => $contragents->categories,
            'tags'          => $contragents->tagsByContragent(),
            'faqs'          => $model->faqs,
            'blocks'        => $model->blocks,
            'products'      => $items,
            'contragentCatalog' => Contragents::whereDefault()->whereAttach()->first()
        ]);

    }

    /**
     * @param Request $request
     * @param Contragents $contragents
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(
        Request $request,
        Category $category,
        Tag $tags,
        Product $product)
    {

        $items = $category->products()->whereTags(app()->request->tags)->paginate(3);

        if (app()->request->ajax())
            return view('partials.loop.catalog-b2b-ajax', compact('items'));

        return view('pages.catalog.b2b.index', [
            'page'          => $category,
            'contragents'   => Contragents::whereB2B()->get(),
            'categories'    => Category::whereB2B()->get(),
            'tags'          => $category->tagsByCategory(),
            'faqs'          => $category->faqs,
            'blocks'        => $category->blocks,
            'products'      => $items,
            'contragentCatalog' => Contragents::whereDefault()->whereAttach()->first()
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category, Product $product)
    {

        return view('pages.catalog.b2b.product', [
            'page' => $product,
        ]);

    }

}
