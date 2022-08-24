<?php

namespace Backend\Http\Controllers\Faq;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Faq\StoreFaqCategoryHandler;
use Backend\Http\Requests\Faq\CategoryRequest;
use Backend\Models\Faq\Categories;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    use ImageUploadTrait;

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

        return view('pages.faq.categories.index', [
            'model' => $model,
            'items' => Categories::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Categories $categories)
    {

        return view('pages.faq.categories.form', [
            'model'         => $categories,
            'categories'    => $categories->all()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, StoreFaqCategoryHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request)) :

            return redirect()->route('faq.categories.edit', $categories)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {

        return view('pages.faq.categories.form', [
            'model'         => $categories,
            'categories'    => $categories->all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, StoreFaqCategoryHandler $handler, Categories $categories)
    {

        if ($categories = $handler->process($request, $categories)) :

            return redirect()->route('faq.categories.edit', $categories)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {

        if ($categories->delete()) :

            $this->imageRemove($categories, 'faq/categories');

            return redirect()->route('faq.categories.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Categories $categories
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Categories $categories)
    {

        return view('pages.faq.categories.seo', [
            'model' => $categories,
        ]);

    }
}
