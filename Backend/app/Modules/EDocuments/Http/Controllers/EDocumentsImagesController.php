<?php

namespace Backend\Modules\EDocuments\Http\Controllers;

use Backend\Modules\EDocuments\Enums\EDocumentsDocsExtensionEnum;
use Backend\Modules\EDocuments\Enums\EDocumentsPlaceholdersEnum;
use Backend\Modules\EDocuments\Http\Handlers\StoreEDocumentsDocsHandler;
use Backend\Modules\EDocuments\Http\Handlers\StoreEDocumentsImagesHandler;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsDocsRequest;
use Backend\Modules\EDocuments\Http\Requests\EDocumentsImagesRequest;
use Backend\Modules\EDocuments\Models\EDocuments;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Modules\EDocuments\Models\EDocumentsImages;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class EDocumentsImagesController extends Controller
{

    use ImageUploadTrait;

    public function __construct()
    {
        $this->middleware('permission:modules_edocuments_documents_access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EDocumentsDocs $document)
    {

        return view('EDocuments::images.index', [
            'items' => $document->images()->paginate(20),
            'document' => $document,
        ]);

    }

    /**
     * @param EDocumentsDocs $documents
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(EDocumentsDocs $document, EDocumentsImages $image)
    {

        return view('EDocuments::images.form', [
            'model' => $image,
            'document' => $document,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EDocumentsImagesRequest $request, StoreEDocumentsImagesHandler $handler, EDocumentsDocs $document)
    {

        if ($image = $handler->process($request, $document))
        {

            return redirect()->route('edocuments.images.index', ['document' => $document])->with('message', __( 'Сохранено' ));

        }

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EDocumentsDocs $document, EDocumentsImages $image)
    {

        return view('EDocuments::images.form', [
            'model' => $image,
            'document' => $document,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EDocumentsImagesRequest $request, StoreEDocumentsImagesHandler $handler, EDocumentsDocs $document, EDocumentsImages $image)
    {

        if ($document = $handler->process($request, $document, $image)) :

            return redirect()->route('edocuments.images.index', $document)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EDocumentsDocs $document, EDocumentsImages $image)
    {
        if ($image->delete()) :

            $this->imageRemove($image, 'modules/edocuments/images');

            return redirect()->route('edocuments.images.index', $document);

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);
    }

}
