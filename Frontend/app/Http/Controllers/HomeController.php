<?php

namespace Frontend\Http\Controllers;

use Frontend\Models\Pages;
use Frontend\Models\Reviews;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('home');

        return view('index', [
            'page'      => $model,
            'faqs'      => $model->faqs,
            'blocks'    => $model->blocks,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
