<?php

namespace Frontend\Http\Controllers;

use Frontend\Models\Pages;
use Frontend\Models\Partners\Categories;
use Frontend\Models\Partners\Partners;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('partners');
        $firstCategory = Categories::first()->id;

        return view('pages.partners.index', [
            'page'          => $model,
            'categories'    => Categories::all(),
            'items'         => Partners::where('category_id', $firstCategory)->get(),
            'faqs'          => $model->faqs,
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

    /**
     * @param Request $request
     * @param Categories $categories
     * @return void
     */
    public function category(Request $request, Pages $pages, Categories $categories)
    {

        $model = $pages->findOrFail('partners');

        return view('pages.partners.index', [
            'page'          => $model,
            'categories'    => Categories::all(),
            'items'         => Partners::where('category_id', $categories->id)->get(),
            'blocks'        => $model->blocks,
        ]);

    }

}
