<?php

namespace Backend\Http\Controllers\Catalog\B2B\Shortcode;

use Backend\Http\Controllers\Controller;
use Backend\Models\Catalog\Product;
use Backend\Models\Constructor\ConstructorShortcode;
use Backend\Models\Pages;

class ConstructorDinamycController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:catalog_access');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Pages $pages, Product $product, ConstructorShortcode $shortcode)
    {

        $page = $pages->findOrFail('b2b');

        return view('pages.constructor.dinamyc.index', [
            'page' => $page,
            'model' => $product,
            'shortcodes' => $shortcode->get(),
        ]);

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Pages $pages)
    {

        //

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Pages $pages)
    {

        //

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Pages $pages)
    {

        //

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Pages $pages)
    {

        //

    }

    /**
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pages $pages)
    {

        //

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
