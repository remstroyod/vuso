<?php

namespace Backend\Http\Controllers\Sales;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Sales\StoreSalesCategoriesHandler;
use Backend\Http\Requests\Sales\SalesCategoriesRequest;
use Backend\Models\Sales\Categories;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.sales.categories.index', [
            'items' => Categories::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categories $categories)
    {

        return view('pages.sales.categories.form', [
            'model' => $categories,
            'categories' => $categories->all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesCategoriesRequest $request, StoreSalesCategoriesHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request)) :

            return redirect()->route('sales.categories.edit', $categories)->with('message', __( 'Сохранено' ));

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

        return view('pages.sales.categories.form', [
            'model' => $categories,
            'categories' => $categories->whereNotCurrentId($categories->id)->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalesCategoriesRequest $request, StoreSalesCategoriesHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request, $categories)) :

            return redirect()->route('sales.categories.edit', $categories)->with('message', __( 'Сохранено' ));

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
            return redirect()->route('sales.categories.index');
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

        return view('pages.sales.categories.seo', [
            'model' => $categories,
        ]);

    }
}
