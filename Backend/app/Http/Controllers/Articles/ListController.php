<?php

namespace Backend\Http\Controllers\Articles;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Articles\StoreArticlesListHandler;
use Backend\Http\Requests\Articles\ArticlesRequest;
use Backend\Http\Requests\Articles\ListRequest;
use Backend\Models\Articles\Articles;
use Backend\Models\Articles\Categories;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ListController extends Controller
{

    use ImageUploadTrait;


    public function __construct()
    {
        $this->middleware('permission:articles_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pages $pages)
    {

        $model = $pages->findOrFail('articles');
        $categories = Categories::all();

        return view('pages.articles.list.index', [
            'model' => $model,
            'items' => Articles::search($request->all())->paginate(10),
            'categories' => $categories,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Articles $articles)
    {

        $categories = new Categories();

        return view('pages.articles.list.form', [
            'model'         => $articles,
            'categories'    => $categories->whereCategoriesTree()->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListRequest $request, StoreArticlesListHandler $handler, Articles $articles)
    {

        if ($articles = $handler->process($request)) :

            return redirect()->route('articles.list.edit', $articles)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Articles $articles)
    {

        $categories = new Categories();

        return view('pages.articles.list.form', [
            'model'             => $articles,
            'categories'        => $categories->all(),
            'categories_tree'   => $categories->whereCategoriesTree()->get()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListRequest $request, StoreArticlesListHandler $handler, Articles $articles)
    {

        if ($articles = $handler->process($request, $articles)) :

            return redirect()->route('articles.list.edit', $articles)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $articles)
    {

        if ($articles->delete()) :

            $this->imageRemove($articles, 'articles');

            return redirect()->route('articles.list.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Articles $articles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Articles $articles)
    {

        return view('pages.articles.list.seo', [
            'model' => $articles,
        ]);

    }
}
