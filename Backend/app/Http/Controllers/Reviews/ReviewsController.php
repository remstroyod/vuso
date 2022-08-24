<?php

namespace Backend\Http\Controllers\Reviews;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\ReviewsRequest;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\Pages;
use Backend\Models\Reviews;
use Exception;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:reviews_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {

        $model = $pages->findOrFail('reviews');

        return view('pages.reviews.form', [
            'model' => $model,
            'parents' => $model->whereStatic()->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagesRequest $request, StorePagesHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('reviews.edit')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param SeoRequest $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(SeoRequest $request, Pages $pages)
    {

        $model = $pages->findOrFail('reviews');
        return view('pages.reviews.seo', [
            'model' => $model,
            'page'  => 'reviews'
        ]);

    }
}
