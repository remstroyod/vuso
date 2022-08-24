<?php

namespace Backend\Http\Controllers\PaymentDelivery;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\PaymentDelivery\PaymentDeliveryRequest;
use Backend\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class PaymentDeliveryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:pages_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {

        $model = $pages->findOrFail('payment_delivery');

        return view('pages.payment_delivery.form', [
            'model' => $model,
            'parents' => $model->whereStatic()->get(),
        ]);

    }

    /**
     * @param PagesRequest $request
     * @param StorePagesHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PagesRequest $request, StorePagesHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('payment_delivery.edit')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Request $request
     * @param Pages $pages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Request $request, Pages $pages)
    {

        $model = $pages->findOrFail('payment_delivery');
        return view('pages.payment_delivery.seo', [
            'model'         => $model,
        ]);

    }
}
