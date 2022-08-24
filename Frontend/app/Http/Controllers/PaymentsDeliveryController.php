<?php
namespace Frontend\Http\Controllers;

use Frontend\Models\PaymentDelivery\Categories;
use Frontend\Models\Pages;

class PaymentsDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('payment_delivery');

        return view('pages.payment_delivery.index', [
            'page'          => $model,
            'categories'    => Categories::get(),
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
