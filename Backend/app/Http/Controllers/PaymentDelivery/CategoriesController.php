<?php

namespace Backend\Http\Controllers\PaymentDelivery;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\PaymentDelivery\StorePaymentDeliveryCategoriesHandler;
use Backend\Http\Requests\PaymentDelivery\PaymentDeliveryCategoriesRequest;
use Backend\Models\PaymentDelivery\Categories;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.payment_delivery.categories.index', [
            'items' => Categories::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categories $categories)
    {

        return view('pages.payment_delivery.categories.form', [
            'model'         => $categories,
            'categories'    => Categories::whereParents()->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentDeliveryCategoriesRequest $request, StorePaymentDeliveryCategoriesHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request)) :

            return redirect()->route('payment_delivery.categories.edit', $categories)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {

        return view('pages.payment_delivery.categories.form', [
            'model'         => $categories,
            'categories'    => Categories::whereNotCurrent($categories)->whereParents()->get(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentDeliveryCategoriesRequest $request, StorePaymentDeliveryCategoriesHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request, $categories)) :

            return redirect()->route('payment_delivery.categories.edit', $categories)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {

        if ($categories->delete()) :

            return redirect()->route('payment_delivery.categories.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Categories $categories
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Categories $categories)
    {

        return view('pages.payment_delivery.categories.seo', [
            'model'         => $categories,
        ]);

    }
}
