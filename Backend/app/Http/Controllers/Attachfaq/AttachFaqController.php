<?php

namespace Backend\Http\Controllers\Attachfaq;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Attachfaq\StoreAttachFaqHandler;
use Backend\Http\Requests\Attachfaq\AttachFaqRequest;
use Backend\Models\Faq\Faq;
use Backend\Models\Pages;
use Backend\Traits\BlocksTrait;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AttachFaqController extends Controller
{

    use ImageUploadTrait, BlocksTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Faq $faq, Pages $page)
    {

        return view('attachfaq.form', [
            'model' => $page,
            'items' => $page->faqs->map->id->toArray(),
            'faqs' => $faq->all(),
        ]);

    }

    /**
     * @param AttachFaqRequest $request
     * @param StoreAttachFaqHandler $handler
     * @param Pages $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttachFaqRequest $request, StoreAttachFaqHandler $handler, Pages $page)
    {

        if ($page = $handler->process($request, $page)) :

            return redirect()->route('attach.faq.form', ['page' => $page])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }




}
