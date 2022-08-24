<?php

namespace Backend\Modules\EDocuments\Http\Controllers;

use Backend\Modules\EDocuments\Enums\EDocumentsEnum;
use Backend\Modules\EDocuments\Http\Handlers\StoreEDocumentsHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsRequest;
use Backend\Modules\EDocuments\Models\EDocuments;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Traits\GoogleDrive;
use Illuminate\Http\Request;

class EDocumentsController extends Controller
{

    use GoogleDrive;

    public function __construct()
    {
        $this->middleware('permission:modules_edocuments_type_access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = EDocuments::paginate(20);
        $type = EDocumentsEnum::toArray();

        return view('EDocuments::type.index', [
            'items' => $documents,
            'type' => (object) $type,
        ]);
    }

    /**
     * @param EDocuments $documents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(EDocuments $documents)
    {

        $folders = $this->listFolders();
        $use = EDocumentsEnum::$use;

        return view('EDocuments::type.form', [
            'model' => $documents,
            'use'   => $use,
            'folders'   => $folders,
            'templates' => EDocumentsDocs::all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EDocumentsRequest $request, StoreEDocumentsHandler $handler, EDocuments $document)
    {

        if ($document = $handler->process($request)) :

            return redirect()->route('edocuments.type.edit', $document)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EDocuments $document)
    {

        $folders = $this->listFolders();

        $use = EDocumentsEnum::$use;

        return view('EDocuments::type.form', [
            'model'     => $document,
            'use'       => $use,
            'folders'   => $folders,
            'templates' => EDocumentsDocs::all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EDocumentsRequest $request, StoreEDocumentsHandler $handler, EDocuments $document)
    {

        if ($document = $handler->process($request, $document)) :

            return redirect()->route('edocuments.type.edit', $document)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EDocuments $document)
    {
        if ($document->delete()) :

            return redirect()->route('edocuments.type.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);
    }

}
