<?php

namespace Backend\Http\Controllers\Sales;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\Sales\SalesRequest;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:sales_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {

        $model = $pages->findOrFail('sales');

        return view('pages.sales.form', [
            'model' => $model,
            'parents' => $model->whereStatic()->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagesRequest $request, StorePagesHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('sales.edit')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param SeoRequest $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(SeoRequest $request, Pages $pages)
    {

        $model = $pages->findOrFail('sales');
        return view('pages.sales.seo', [
            'model' => $model,
            'page'  => 'sales'
        ]);

    }
}
