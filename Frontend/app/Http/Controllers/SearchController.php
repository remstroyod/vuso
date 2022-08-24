<?php

namespace Frontend\Http\Controllers;

use Backend\Placeholders\Placeholders;
use Frontend\Models\Articles\Articles;
use Frontend\Models\Catalog\Product;
use Frontend\Models\Informations\Informations;
use Frontend\Models\Pages;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pages $pages)
    {

        $model = $pages->findOrFail('search');

        $products = Product::search($request)->get();
        $articles = Articles::search($request)->get();
        $informations = Informations::search($request)->get();
        $getpages = $pages->search($request)->get();

        return view('pages.search.index', [
            'page'      => $model,
            'products'  => $products,
            'articles'  => $articles,
            'informations'  => $informations,
            'pages' => $getpages,
            'count' => $products->count() + $articles->count() + $informations->count(),
            'blocks' => $model->blocks->where('model', 'page'),
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
