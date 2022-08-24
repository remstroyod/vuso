<?php

namespace Backend\Http\Controllers\Partners;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Partners\StorePartnersListHandler;
use Backend\Http\Requests\Partners\PartnersListRequest;
use Backend\Models\Partners\Categories;
use Backend\Models\Partners\Partners;
use Backend\Models\Tag;
use Backend\Traits\ImageUploadTrait;

class ListController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.partners.list.index', [
            'items' => Partners::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Partners $partners)
    {

        return view('pages.partners.list.form', [
            'model'         => $partners,
            'categories'    => Categories::all(),
            'tags'          => Tag::wherePages()->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnersListRequest $request, StorePartnersListHandler $handler, Partners $partners)
    {

        if ($partners = $handler->process($request)) :

            return redirect()->route('partners.list.edit', $partners)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Partners $partners)
    {

        return view('pages.partners.list.form', [
            'model'         => $partners,
            'categories'    => Categories::all(),
            'tags'          => Tag::wherePages()->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnersListRequest $request, StorePartnersListHandler $handler, Partners $partners)
    {

        if ($partners = $handler->process($request, $partners)) :

            return redirect()->route('partners.list.edit', $partners)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partners $partners)
    {

        if ($partners->delete()) :

            $this->imageRemove($partners, 'partners');
            return redirect()->route('partners.list.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Partners $articles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Partners $partners)
    {

        return view('pages.partners.list.seo', [
            'model' => $partners,
        ]);

    }
}
