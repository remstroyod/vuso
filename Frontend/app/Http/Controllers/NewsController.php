<?php

namespace Frontend\Http\Controllers;

use Frontend\Models\Articles\Articles;
use Frontend\Models\Articles\Categories;
use Frontend\Models\Pages;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Categories $category, Pages $pages)
    {

        $model = $pages->findOrFail('articles');
        $items = Articles::paginate(9);

        if ($request->ajax())
            return view('partials.loop.news-ajax', compact('items'));

        return view('pages.news.index', [
            'page'      => $model,
            'items'     => $items,
            'category'  => $category,
            'faqs'      => $model->faqs,
            'blocks'    => $model->blocks,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $category, Articles $articles)
    {

        return view('pages.news.show', [
            'page' => $articles
        ]);

    }

}
