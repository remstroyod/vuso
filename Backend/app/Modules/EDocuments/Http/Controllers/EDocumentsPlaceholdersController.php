<?php

namespace Backend\Modules\EDocuments\Http\Controllers;

use Backend\Modules\EDocuments\Http\Handlers\StoreEDocumentsPlaceholdersHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsPlaceholdersRequest;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Illuminate\Http\Request;

class EDocumentsPlaceholdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:modules_edocuments_placeholders_access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $placeholders  = EDocumentsPlaceholders::paginate(30);

        return view('EDocuments::placeholders.index', [
            'items' => $placeholders,
        ]);

    }

    /**
     * @param EDocumentsPlaceholders $placeholder
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(EDocumentsPlaceholders $placeholder)
    {

        return view('EDocuments::placeholders.form', [
            'model' => $placeholder,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EDocumentsPlaceholdersRequest $request, StoreEDocumentsPlaceholdersHandler $handler, EDocumentsPlaceholders $placeholder)
    {

        if ($placeholder = $handler->process($request)) :

            return redirect()->route('edocuments.placeholders.edit', $placeholder)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EDocumentsPlaceholders $placeholder)
    {

        return view('EDocuments::placeholders.form', [
            'model' => $placeholder,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EDocumentsPlaceholdersRequest $request, StoreEDocumentsPlaceholdersHandler $handler, EDocumentsPlaceholders $placeholder)
    {

        if ($placeholder = $handler->process($request, $placeholder)) :

            return redirect()->route('edocuments.placeholders.edit', $placeholder)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EDocumentsPlaceholders $placeholder)
    {
        if ($placeholder->delete()) :

            return redirect()->route('edocuments.placeholders.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);
    }

}
