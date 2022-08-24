<?php

namespace Frontend\Http\Controllers;

use Frontend\Models\Pages;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('about');

        return view('pages.about.index', [
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
