<?php

namespace Frontend\Http\Controllers;

use Frontend\Models\Articles\Articles;
use Frontend\Models\Articles\Categories;
use Frontend\Models\Pages;
use Frontend\Models\Sales\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        return view('pages.news.index', [
            'page'  => $pages->findOrFail('sales'),
            'items' => Sales::paginate(8)
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sale)
    {

        return view('pages.news.show', [
            'model' => $sale
        ]);

    }

}
