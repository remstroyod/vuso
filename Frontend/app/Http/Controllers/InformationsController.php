<?php
namespace Frontend\Http\Controllers;

use Frontend\Models\Informations\Categories;
use Frontend\Models\Pages;

class InformationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('informations');

        return view('pages.informations.index', [
            'page' => $model,
            'categories' => Categories::parent()->get(),
            'categoriesTab' => Categories::get(),
            'faqs'      => $model->faqs,
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
