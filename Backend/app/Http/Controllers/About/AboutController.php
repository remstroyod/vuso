<?php

namespace Backend\Http\Controllers\About;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\About\About;
use Backend\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:pages_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {

        $model = $pages->findOrFail('about');

        return view('pages.about.form', [
            'model' => $model,
            'parents' => $model->whereStatic()->get(),
        ]);

    }

    /**
     * @param PagesRequest $request
     * @param StorePagesHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PagesRequest $request, StorePagesHandler $handler, Pages $pages): \Illuminate\Http\RedirectResponse
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('about.edit')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(SeoRequest $request, Pages $pages)
    {

        $model = $pages->findOrFail('about');
        return view('pages.about.seo', [
            'model' => $model,
            'page'  => 'about'
        ]);

    }
}
