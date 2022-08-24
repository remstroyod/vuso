<?php

namespace Frontend\Http\Controllers;

use Frontend\Models\Pages;

class ConstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        return view('constructor.index', [
            'page' => $pages,
        ]);

    }

}
