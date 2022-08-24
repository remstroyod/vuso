<?php

namespace Backend\Http\Controllers\Faq;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\Faq\FaqRequest;
use Backend\Http\Requests\PagesRequest;
use Backend\Models\Faq\Faq;
use Backend\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:faq_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {

        $model = $pages->findOrFail('faq');

        return view('pages.faq.form', [
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

            return redirect()->route('faq.edit')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Request $request, Pages $pages)
    {

        $model = $pages->findOrFail('faq');
        return view('pages.faq.seo', [
            'model' => $model,
        ]);

    }
}
