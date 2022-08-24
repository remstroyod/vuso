<?php

namespace Backend\Http\Controllers\Reviews;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Reviews\StoreReviewsListHandler;
use Backend\Http\Requests\Reviews\ReviewsListRequest;
use Backend\Models\Reviews;
use Backend\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.reviews.list.index', [
            'items' => Reviews::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Reviews $reviews)
    {

        return view('pages.reviews.list.form', [
            'model' => $reviews
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewsListRequest $request, StoreReviewsListHandler $handler, Reviews $reviews)
    {

        if ($reviews = $handler->process($request)) :

            return redirect()->route('reviews.list.edit', $reviews)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviews $reviews)
    {

        return view('pages.reviews.list.form', [
            'model' => $reviews
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewsListRequest $request, StoreReviewsListHandler $handler, Reviews $reviews)
    {

        if ($reviews = $handler->process($request, $reviews)) :

            return redirect()->route('reviews.list.edit', $reviews)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reviews $reviews)
    {

        if ($reviews->delete()) :

            $this->imageRemove($reviews, 'reviews');
            return redirect()->route('reviews.list.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Reviews $reviews
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Reviews $reviews)
    {

        return view('pages.reviews.list.seo', [
            'model' => $reviews,
        ]);

    }
}
