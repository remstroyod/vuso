<?php

namespace Backend\Http\Controllers\Constructor;

use Backend\Http\Handlers\Constructor\StoreConstructorDinamycHandler;
use Backend\Http\Requests\Constructor\ConstructorDinamycRequest;
use Backend\Models\Constructor\ConstructorShortcode;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Backend\Http\Controllers\Controller;
use Backend\Models\Constructor\ConstructorDinamic;
use Backend\Models\Pages;

class ConstructorDinamycShortcodeController extends Controller
{

    use ImageUploadTrait;

    public function __construct()
    {
        $this->middleware('permission:constructor_access');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request, Pages $pages, ConstructorDinamic $dinamic)
    {

        return view('pages.constructor.dinamyc.shortcode.index', [
            'model' => $pages,
            'items' => $dinamic->whereShortcode($pages, $request->shortcode)->paginate(20),
            'shortcode' => ConstructorShortcode::where('shortcode', $request->shortcode)->first(),
        ]);

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request, Pages $pages, ConstructorDinamic $item)
    {

        return view('pages.constructor.dinamyc.shortcode.form', [
            'model' => $pages,
            'item' => $item,
            'shortcode' => ConstructorShortcode::where('shortcode', $request->shortcode)->first(),
        ]);

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConstructorDinamycRequest $request, StoreConstructorDinamycHandler $handler, ConstructorDinamic $item, Pages $pages)
    {

        if ($item = $handler->process($request)) :

            return redirect()->route('constructor.dinamyc.shortcode.index', [
                'pages' => $pages,
                'shortcode' => $request->shortcode
            ])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Pages $pages, ConstructorDinamycRequest $request, StoreConstructorDinamycHandler $handler, ConstructorDinamic $item)
    {

        if ($item = $handler->process($request, $item)) :

            return redirect()->route('constructor.dinamyc.shortcode.index', [
                'pages' => $pages,
                'shortcode' => $request->shortcode
            ])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Pages $pages, Request $request, ConstructorDinamic $item)
    {

        return view('pages.constructor.dinamyc.shortcode.form', [
            'model' => $pages,
            'item' => $item,
            'shortcode' => ConstructorShortcode::where('shortcode', $request->shortcode)->first(),
        ]);

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pages $pages, Request $request, ConstructorDinamic $item)
    {

        if ($item->delete()) :

            $this->imageRemove($item, 'constructor/dinamyc');

            return redirect()->route('constructor.dinamyc.shortcode.index', [
                'pages' => $pages,
                'shortcode' => $request->shortcode
            ]);

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

        //

    }

}
