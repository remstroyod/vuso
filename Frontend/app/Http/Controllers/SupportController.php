<?php
namespace Frontend\Http\Controllers;

use Frontend\Models\Pages;

class SupportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('support');

        return view('pages.support.index', [
            'page' => $model,
            'faqs' => $model->faqs,
            'blocks' => $model->blocks,
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
