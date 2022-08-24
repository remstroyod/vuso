<?php

namespace Backend\Http\Controllers\Constructor;

use Backend\Models\Constructor\ConstructorShortcode;
use Illuminate\Http\Request;
use Backend\Http\Controllers\Controller;
use Backend\Models\Pages;

class ConstructorShortcodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:constructor_access');
    }


    /**
     * @param Pages $pages
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Pages $pages, Request $request)
    {

        $shortcode = ConstructorShortcode::where('shortcode', $request->shortcode)->first();
        $shortcode->fill($request->all());
        $shortcode->save($request->all());

        return redirect()->route('constructor.dinamyc.shortcode.index', [
            'pages' => $pages,
            'shortcode' => $request->shortcode
        ])->with('message', __( 'Сохранено' ));

    }


}
