<?php
namespace Frontend\Http\Controllers;

use Frontend\Models\Faq\Categories;
use Frontend\Models\Pages;
use Frontend\Models\Faq\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('faq');

        return view('pages.faq.index', [
            'page'          => $model,
            'categories'    => Categories::all(),
            'items'         => Faq::all(),
            'blocks'        => $model->blocks,
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
