<?php

namespace Backend\Http\Controllers\Constructor;

use Backend\Enums\PagesTypeEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Constructor\StoreBuilderHandler;
use Backend\Http\Handlers\Constructor\StoreConstructorHandler;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\Constructor\ConstructorRequest;
use Backend\Http\Requests\PagesRequest;
use Backend\Models\Pages;

class ConstructorController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:constructor_access');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        return view('pages.constructor.index', [
            'items' => Pages::whereConstructor()->paginate()
        ]);

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Pages $pages)
    {

        return view('pages.constructor.form', [
            'model' => $pages
        ]);

    }

    /**
     * @param ConstructorRequest $request
     * @param StorePagesHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PagesRequest $request, StoreConstructorHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request)) :

            return redirect()->route('constructor.edit', $pages)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param PagesRequest $request
     * @param StoreConstructorHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PagesRequest $request, StoreConstructorHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('constructor.edit', $pages)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Pages $pages)
    {

        return view('pages.constructor.form', [
            'model' => $pages
        ]);

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pages $pages)
    {

        if ($pages->delete()) :
            return redirect()->route('constructor.index');
        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param $id
     * @return void
     */
    public function show(Pages $pages)
    {

        return view('pages.constructor.builder', [
            'model' => $pages
        ]);

    }

    /**
     * @param PagesRequest $request
     * @param StoreBuilderHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function builder(PagesRequest $request, StoreBuilderHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('constructor.show', $pages)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Pages $pages)
    {

        return view('pages.constructor.seo', [
            'model' => $pages,
        ]);

    }
}
