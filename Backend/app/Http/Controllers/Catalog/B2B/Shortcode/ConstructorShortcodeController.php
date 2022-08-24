<?php

namespace Backend\Http\Controllers\Catalog\B2B\Shortcode;

use Backend\Models\Catalog\Product;
use Backend\Models\Constructor\ConstructorShortcode;
use Illuminate\Http\Request;
use Backend\Http\Controllers\Controller;
use Backend\Models\Pages;

class ConstructorShortcodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:catalog_access');
    }


    /**
     * @param Product $product
     * @param Pages $pages
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, Pages $pages, Request $request)
    {

        $page = $pages->findOrFail('b2b');

        $shortcode = ConstructorShortcode::where('shortcode', $request->shortcode)->first();
        $shortcode->fill($request->all());
        $shortcode->save($request->all());

        return redirect()->route('b2b.constructor.dinamyc.shortcode.index', [
            'product' => $product,
            'shortcode' => $request->shortcode
        ])->with('message', __( 'Сохранено' ));

    }


}
