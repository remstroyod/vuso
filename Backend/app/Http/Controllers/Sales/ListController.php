<?php

namespace Backend\Http\Controllers\Sales;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Sales\StoreSalesListHandler;
use Backend\Http\Requests\Sales\SalesListRequest;
use Backend\Models\Sales\Categories;
use Backend\Models\Sales\Sales;
use Backend\Traits\FileUploadTrait;
use Backend\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
{

    use ImageUploadTrait, FileUploadTrait;

    public function __construct()
    {
        $this->middleware('permission:sales_access');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.sales.list.index', [
            'items' => Sales::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sales $sales)
    {

        return view('pages.sales.list.form', [
            'model'         => $sales,
            'categories'    => Categories::all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesListRequest $request, StoreSalesListHandler $handler, Sales $sales)
    {

        if ($sales = $handler->process($request)) :

            return redirect()->route('sales.list.edit', $sales)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {

        return view('pages.sales.list.form', [
            'model'         => $sales,
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
    public function update(SalesListRequest $request, StoreSalesListHandler $handler, Sales $sales)
    {

        if ($sales = $handler->process($request, $sales)) :

            return redirect()->route('sales.list.edit', $sales)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {

        if ($sales->delete()) :

            $this->imageRemove($sales, 'sales');
            $this->fileRemove($sales, 'sales');

            return redirect()->route('sales.list.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Sales $sales
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function seo(Sales $sales)
    {

        return view('pages.sales.list.seo', [
            'model' => $sales,
        ]);

    }
}
