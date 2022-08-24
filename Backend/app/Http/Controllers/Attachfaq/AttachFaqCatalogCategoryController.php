<?php

namespace Backend\Http\Controllers\Attachfaq;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Attachfaq\StoreAttachFaqCatalogControllerHandler;
use Backend\Http\Handlers\Attachfaq\StoreAttachFaqHandler;
use Backend\Http\Requests\Attachfaq\AttachFaqRequest;
use Backend\Models\Catalog\Category;
use Backend\Models\Faq\Faq;
use Backend\Models\Pages;
use Backend\Traits\BlocksTrait;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class AttachFaqCatalogCategoryController extends Controller
{

    use ImageUploadTrait, BlocksTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Faq $faq, Pages $page, Category $category)
    {

        return view('attachfaq.form', [
            'model' => $page,
            'items' => $category->faqs->map->id->toArray(),
            'faqs' => $faq->all(),
            'category' => $category,
        ]);

    }

    /**
     * @param AttachFaqRequest $request
     * @param StoreAttachFaqCatalogControllerHandler $handler
     * @param Pages $page
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttachFaqRequest $request, StoreAttachFaqCatalogControllerHandler $handler, Pages $page, Category $category)
    {

        if ($category = $handler->process($request, $category)) :

            return redirect()->route('attach.faq.catalog.category.form', ['page' => $page, 'category' => $category])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

}
