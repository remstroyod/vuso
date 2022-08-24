<?php

namespace Backend\Http\Controllers\Constructor;

use Backend\Http\Controllers\Controller;
use Backend\Models\Constructor\ConstructorShortcode;
use Backend\Models\Pages;

class ConstructorDinamycController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:constructor_access');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Pages $pages, ConstructorShortcode $shortcode)
    {

        return view('pages.constructor.dinamyc.index', [
            'model' => $pages,
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
