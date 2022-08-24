<?php

namespace Backend\Modules\EDocuments\Http\Controllers;

use Backend\Modules\EDocuments\Enums\EDocumentsDocsExtensionEnum;
use Backend\Modules\EDocuments\Enums\EDocumentsPlaceholdersEnum;
use Backend\Modules\EDocuments\Http\Handlers\StoreEDocumentsDocsHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsDocsRequest;
use Backend\Modules\EDocuments\Models\EDocuments;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Modules\EDocuments\Models\EDocumentsImages;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class EDocumentsDocsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:modules_edocuments_documents_access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $documents  = EDocumentsDocs::paginate(20);
        $extensions = EDocumentsDocsExtensionEnum::$name;

        return view('EDocuments::index', [
            'items'         => $documents,
            'extensions'    => $extensions,
        ]);

    }

    /**
     * @param EDocumentsDocs $documents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(EDocumentsDocs $documents)
    {

        $extensions = EDocumentsDocsExtensionEnum::$name;
        $types = EDocuments::all();
        $extension_rule = (object) EDocumentsDocsExtensionEnum::toArray();
        $placeholders = EDocumentsPlaceholders::all();
        $systems_placeholders = EDocumentsPlaceholdersEnum::complete();

        return view('EDocuments::form', [
            'model'                 => $documents,
            'extensions'            => $extensions,
            'extension_rule'        => $extension_rule,
            'types'                 => $types,
            'placeholders'          => $placeholders,
            'systems_placeholders'  => $systems_placeholders,
            'images'                => EDocumentsImages::all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EDocumentsDocsRequest $request, StoreEDocumentsDocsHandler $handler, EDocumentsDocs $document)
    {

        if ($document = $handler->process($request)) :

            return redirect()->route('edocuments.edit', $document)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EDocumentsDocs $document)
    {

        $extensions = EDocumentsDocsExtensionEnum::$name;
        $types = EDocuments::all();
        $extension_rule = (object) EDocumentsDocsExtensionEnum::toArray();
        $placeholders = EDocumentsPlaceholders::all();
        $systems_placeholders = EDocumentsPlaceholdersEnum::complete();

        return view('EDocuments::form', [
            'model'                 => $document,
            'extensions'            => $extensions,
            'extension_rule'        => $extension_rule,
            'types'                 => $types,
            'placeholders'          => $placeholders,
            'systems_placeholders'  => $systems_placeholders,
            'images'                => EDocumentsImages::all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EDocumentsDocsRequest $request, StoreEDocumentsDocsHandler $handler, EDocumentsDocs $document)
    {

        if ($document = $handler->process($request, $document)) :

            return redirect()->route('edocuments.edit', $document)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EDocumentsDocs $document)
    {
        if ($document->delete()) :

            return redirect()->route('edocuments.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);
    }

}
