<?php

namespace Backend\Http\Controllers\Articles;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Articles\StoreArticlesCategoryHandler;
use Backend\Http\Requests\Articles\CategoryRequest;
use Backend\Models\Articles\Articles;
use Backend\Models\Articles\Categories;
use Backend\Models\Pages;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:articles_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('articles');

        return view('pages.articles.categories.index', [
            'model' => $model,
            'items' => Categories::paginate(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categories $categories)
    {

        return view('pages.articles.categories.form', [
            'model'         => $categories,
            'categories'    => $categories->all()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, StoreArticlesCategoryHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request)) :

            return redirect()->route('articles.categories.edit', $categories)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {

        return view('pages.articles.categories.form', [
            'model'         => $categories,
            'categories'    => $categories->whereNotCurrentId($categories->id)->get()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, StoreArticlesCategoryHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request, $categories)) :

            return redirect()->route('articles.categories.edit', $categories)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {

        if ($categories->delete()) :
            return redirect()->route('articles.categories.index');
        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Articles $articles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Categories $categories)
    {

        return view('pages.articles.categories.seo', [
            'model'         => $categories,
        ]);

    }
}
