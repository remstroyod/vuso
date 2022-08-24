<?php

namespace Backend\Http\Controllers\Informations;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\Informations\InformationsRequest;
use Backend\Http\Requests\PagesRequest;
use Backend\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class InformationsController extends Controller
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

        $model = $pages->findOrFail('informations');

        return view('pages.informations.form', [
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
    public function update(PagesRequest $request, StorePagesHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('informations.edit')->with('message', __( 'Сохранено' ));

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

        $model = $pages->findOrFail('informations');
        return view('pages.informations.seo', [
            'model'         => $model,
        ]);

    }
}
