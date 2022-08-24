<?php

namespace Backend\Http\Controllers\Faq;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Faq\StoreFaqListHandler;
use Backend\Http\Requests\Faq\FaqRequest;
use Backend\Models\Faq\Faq;
use Backend\Models\Faq\Categories;
use Backend\Models\Pages;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:faq_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pages $pages)
    {

        $model = $pages->findOrFail('faq');

        return view('pages.faq.list.index', [
            'model' => $model,
            'items' => Faq::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Faq $faq)
    {

        return view('pages.faq.list.form', [
            'model'         => $faq,
            'categories'    => Categories::all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request, StoreFaqListHandler $handler, Faq $faq)
    {

        if ($faq = $handler->process($request)) :

            return redirect()->route('faq.list.edit', $faq)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {

        return view('pages.faq.list.form', [
            'model'         => $faq,
            'categories'    => Categories::all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, StoreFaqListHandler $handler, Faq $faq)
    {

        if ($faq = $handler->process($request, $faq)) :

            return redirect()->route('faq.list.edit', $faq)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {

        if ($faq->delete()) :
            return redirect()->route('faq.list.index');
        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Faq $faq
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Faq $faq)
    {

        return view('pages.faq.list.seo', [
            'model' => $faq,
        ]);

    }
}
