<?php
namespace Frontend\Http\Controllers;

use Backend\Enums\PagesTypeEnum;
use Frontend\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StaticPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pages $pages)
    {

        $model = $pages->where('type', PagesTypeEnum::dynamic)->findOrFail($request->slug);

        return view('pages.static-pages.index', [
            'page' => $model,
            'faqs'      => $model->faqs,
            'blocks' => $model->blocks,
        ]);

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

}
