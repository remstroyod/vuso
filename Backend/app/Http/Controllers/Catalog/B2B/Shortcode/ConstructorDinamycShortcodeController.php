<?php

namespace Backend\Http\Controllers\Catalog\B2B\Shortcode;

use Backend\Http\Handlers\Constructor\StoreConstructorDinamycHandler;
use Backend\Http\Requests\Constructor\ConstructorDinamycRequest;
use Backend\Models\Catalog\Product;
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
        $this->middleware('permission:catalog_access');
    }

    /**
     * @param Request $request
     * @param Product $product
     * @param Pages $pages
     * @param ConstructorDinamic $dinamic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request, Product $product, Pages $pages, ConstructorDinamic $dinamic)
    {

        $page = $pages->findOrFail('b2b');

        return view('pages.constructor.dinamyc.shortcode.index', [
            'page' => $page,
            'model' => $product,
            'items' => $dinamic->whereShortcode($page, $request->shortcode)->paginate(20),
            'shortcode' => ConstructorShortcode::where('shortcode', $request->shortcode)->first(),
        ]);

    }

    /**
     * @param Request $request
     * @param Product $product
     * @param Pages $pages
     * @param ConstructorDinamic $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request, Product $product, Pages $pages, ConstructorDinamic $item)
    {

        $page = $pages->findOrFail('b2b');

        return view('pages.constructor.dinamyc.shortcode.form', [
            'page' => $page,
            'model' => $product,
            'item' => $item,
            'shortcode' => ConstructorShortcode::where('shortcode', $request->shortcode)->first(),
        ]);

    }

    /**
     * @param ConstructorDinamycRequest $request
     * @param Product $product
     * @param StoreConstructorDinamycHandler $handler
     * @param ConstructorDinamic $item
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConstructorDinamycRequest $request, Product $product, StoreConstructorDinamycHandler $handler, ConstructorDinamic $item, Pages $pages)
    {

        $page = $pages->findOrFail('b2b');

        $request->merge([
            'pages' => $page,
            'product' => $product
        ]);

        if ($item = $handler->process($request)) :

            return redirect()->route('b2b.constructor.dinamyc.shortcode.index', [
                'product' => $product,
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

            return redirect()->route('b2b.constructor.dinamyc.shortcode.index', [
                'pages' => $pages,
                'shortcode' => $request->shortcode
            ])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Pages $pages
     * @param Request $request
     * @param Product $product
     * @param ConstructorDinamic $item
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Pages $pages, Request $request, Product $product, ConstructorDinamic $item)
    {

        $page = $pages->findOrFail('b2b');

        return view('pages.constructor.dinamyc.shortcode.form', [
            'page' => $page,
            'model' => $product,
            'item' => $item,
            'shortcode' => ConstructorShortcode::where('shortcode', $request->shortcode)->first(),
        ]);

    }

    /**
     * @param Pages $pages
     * @param Request $request
     * @param Product $product
     * @param ConstructorDinamic $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pages $pages, Request $request, Product $product, ConstructorDinamic $item)
    {

        if ($item->delete()) :

            $this->imageRemove($item, 'constructor/dinamyc');
            $page = $pages->findOrFail('b2b');

            return redirect()->route('b2b.constructor.dinamyc.shortcode.index', [
                'product' => $product,
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
