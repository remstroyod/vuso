<?php

namespace Backend\Http\Controllers;

use Backend\Http\Handlers\StoreSeoHandler;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\Seo;

class SeoController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeoRequest $request, StoreSeoHandler $handler, Seo $seo)
    {

        if ($seo = $handler->process($request, $seo)) :

            return back()->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
