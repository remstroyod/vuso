<?php

namespace Backend\Http\Controllers\Catalog;

use Backend\Enums\CatalogEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Catalog\StoreCatalogContragentsHandler;
use Backend\Http\Requests\Catalog\CatalogContragentsRequest;
use Backend\Models\Catalog\Contragents;
use Backend\Models\Pages;

class ContragentsController extends Controller
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

        return view('pages.catalog.contragents.index', [
            'model' => $model,
            'items' => Contragents::whereDefault()->paginate(20),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pages $pages, Contragents $contragents)
    {

        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.contragents.form', [
            'page' => $model,
            'model' => $contragents,
            'type' => CatalogEnum::default,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogContragentsRequest $request, StoreCatalogContragentsHandler $handler, Contragents $contragents)
    {

        if ($contragents = $handler->process($request)) :

            return redirect()->route('catalog.contragents.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages, Contragents $contragents)
    {

        $model = $pages->findOrFail('catalog');

        return view('pages.catalog.contragents.form', [
            'page' => $model,
            'model' => $contragents,
            'type' => CatalogEnum::default,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogContragentsRequest $request, StoreCatalogContragentsHandler $handler, Contragents $contragents)
    {

        if ($contragents = $handler->process($request, $contragents)) :

            return redirect()->route('catalog.contragents.edit', $contragents)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contragents $contragents)
    {

        if ($contragents->delete()) :

            return redirect()->route('catalog.contragents.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Contragents $contragents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Contragents $contragents)
    {

        return view('pages.catalog.contragents.seo', [
            'model' => $contragents,
        ]);

    }
}
