<?php

namespace Backend\Http\Controllers\Blocks;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Blocks\StoreBlocksHandler;
use Backend\Http\Handlers\Blocks\StoreElementsHandler;
use Backend\Http\Requests\Blocks\BlocksRequest;
use Backend\Http\Requests\Blocks\ElementsRequest;
use Backend\Models\Blocks\Block;
use Backend\Models\Blocks\BlockElement;
use Backend\Models\Pages;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ElementsStaticPagesController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pages $page, Block $block)
    {

        return view('blocks.elements.index', [
            'model' => $page,
            'items' => $block->elements,
            'block' => $block,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Pages $page, Block $block)
    {

        return view('blocks.elements.form', [
            'page' => $page,
            'block' => $block,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ElementsRequest $request, Pages $page, StoreElementsHandler $handler, Block $block, BlockElement $element)
    {

        if ($element = $handler->process($request, $page, $block)) :

            return redirect()->route('blocks.static.elements.index', ['page' => $page, 'block' => $block])->with('message', __( 'Сохранено' ));

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
    public function edit(Request $request, Pages $page, Block $block, BlockElement $element)
    {

        return view('blocks.elements.form', [
            'page' => $page,
            'block' => $block,
            'item' => $element,
        ]);

    }

    /**
     * @param BlocksRequest $request
     * @param StoreBlocksHandler $handler
     * @param Pages $page
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ElementsRequest $request, Pages $page, StoreElementsHandler $handler, Block $block, BlockElement $element)
    {

        if ($element = $handler->process($request, $page, $block, $element)) :

            return redirect()->route('blocks.static.elements.index', ['page' => $page, 'block' => $block])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pages $page, Block $block, BlockElement $element)
    {

        if ($element->delete()) :

            $this->imageRemove($element, 'blocks/elements');

            return redirect()->route('blocks.static.elements.index', ['page' => $page, 'block' => $block]);

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

}
