<?php

namespace Backend\Http\Controllers\Informations;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Informations\StoreInformationsListHandler;
use Backend\Http\Requests\Informations\InformationsListRequest;
use Backend\Models\Informations\Informations;
use Backend\Models\Informations\Categories;
use Backend\Traits\FileUploadTrait;

class ListController extends Controller
{

    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        return view('pages.informations.list.index', [
            'items' => Informations::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Informations $informations)
    {

        return view('pages.informations.list.form', [
            'model'         => $informations,
            'categories'    => Categories::whereChildrens()->get(),
        ]);

    }

    /**
     * @param InformationsListRequest $request
     * @param StoreInformationsListHandler $handler
     * @param Informations $informations
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InformationsListRequest $request, StoreInformationsListHandler $handler, Informations $informations)
    {

        if ($informations = $handler->process($request)) :

            return redirect()->route('informations.list.edit', $informations)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Informations $informations)
    {

        return view('pages.informations.list.form', [
            'model'         => $informations,
            'categories'    => Categories::whereParents()->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InformationsListRequest $request, StoreInformationsListHandler $handler, Informations $informations)
    {

        if ($informations = $handler->process($request, $informations)) :

            return redirect()->route('informations.list.edit', $informations)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informations $informations)
    {

        if ($informations->delete()) :

            $this->fileRemove($informations, 'informations');
            return redirect()->route('informations.list.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Informations $Informations
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Informations $informations)
    {

        return view('pages.informations.list.seo', [
            'model' => $informations,
        ]);

    }
}
