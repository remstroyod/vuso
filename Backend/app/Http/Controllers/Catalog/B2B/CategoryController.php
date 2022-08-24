<?php

namespace Backend\Http\Controllers\Catalog\B2B;

use Backend\Enums\CatalogEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Catalog\StoreCatalogCategoryHandler;
use Backend\Http\Requests\Catalog\CatalogCategoryRequest;
use Backend\Models\Catalog\Category;
use Backend\Models\Catalog\Contragents;
use Backend\Models\Pages;

class CategoryController extends Controller
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

        $model = $pages->findOrFail('b2b');

        return view('pages.catalog.categories.index', [
            'model' => $model,
            'items' => Category::whereB2B()->paginate(20),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {

        return view('pages.catalog.categories.form', [
            'model'         => $category,
            'categories'    => $category->whereB2B()->get(),
            'contragents'   => Contragents::whereB2B()->get(),
            'type'          => CatalogEnum::b2b,

        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogCategoryRequest $request, StoreCatalogCategoryHandler $handler, Category $category)
    {

        if ($category = $handler->process($request)) :

            return redirect()->route('b2b.categories.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('pages.catalog.categories.form', [
            'model'         => $category,
            'categories'    => $category->whereB2B()->whereNotCurrentId($category->id)->get(),
            'contragents'   => Contragents::whereB2B()->get(),
            'type'          => CatalogEnum::b2b,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogCategoryRequest $request, StoreCatalogCategoryHandler $handler, Category $category)
    {

        if ($category = $handler->process($request, $category)) :

            return redirect()->route('b2b.categories.edit', $category)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        if ($category->delete()) :

            return redirect()->route('b2b.categories.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Contragents $contragents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Category $category)
    {

        return view('pages.catalog.categories.seo', [
            'model' => $category,
        ]);

    }
}
