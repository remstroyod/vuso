<?php

namespace Backend\Http\Controllers\Catalog;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Catalog\StoreCatalogEdocumentsHandler;
use Backend\Models\Catalog\Product;
use Backend\Models\Pages;
use Backend\Modules\EDocuments\Enums\EDocumentsEnum;
use Backend\Modules\EDocuments\Models\EDocuments;
use Illuminate\Http\Request;

class EDocumentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:modules_edocuments_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Request $request,
        Pages $pages,
        Product $product,
        EDocuments $documents)
    {

        $pages = $pages->findOrFail('catalog');
        $documents_type = $documents->all();
        $use = EDocumentsEnum::$use;

        return view('pages.catalog.edocuments.form', [
            'page' => $pages,
            'product' => $product,
            'documents_type' => $documents_type,
            'use' => (object) $use,
        ]);

    }

    /**
     * @param FaqRequest $request
     * @param StoreCatalogFaqHandler $handler
     * @param Pages $pages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, StoreCatalogEdocumentsHandler $handler, Product $product)
    {

        if ($product = $handler->process($request, $product)) :

            return redirect()->route('catalog.edocuments.edit', $product)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
