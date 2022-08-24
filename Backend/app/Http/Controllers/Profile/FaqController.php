<?php

namespace Backend\Http\Controllers\Profile;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Support\StoreSupportFaqHandler;
use Backend\Http\Requests\Support\FaqRequest;
use Backend\Models\Faq\Faq;
use Backend\Models\Pages;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pages $pages, Faq $faq)
    {

        $pages = $pages->findOrFail('profile');

        return view('pages.profile.faq.form', [
            'model' => $pages,
            'faqs' => $faq->all(),
        ]);

    }

    /**
     * @param FaqRequest $request
     * @param StoreSupportFaqHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FaqRequest $request, StoreSupportFaqHandler $handler, Pages $pages)
    {

        if ($pages = $handler->process($request, $pages)) :

            return redirect()->route('profile.faq.edit')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
