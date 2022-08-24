<?php

namespace Backend\Http\Controllers\Blocks;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Blocks\StoreBlocksHandler;
use Backend\Http\Requests\Blocks\BlocksRequest;
use Backend\Models\Blocks\Block;
use Backend\Models\Catalog\Category;
use Backend\Models\Pages;
use Backend\Traits\BlocksTrait;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BlocksProductCategoryController extends Controller
{

    use ImageUploadTrait, BlocksTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pages $page, Category $category)
    {

        return view('blocks.index', [
            'model' => $page,
            'items' => $category->blocks,
            'category' => $category,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Pages $page, Block $block, Category $category)
    {

        return view('blocks.form', [
            'page' => $page,
            'templates' => $this->blocksTemplates(),
            'category' => $category,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlocksRequest $request, Pages $page, StoreBlocksHandler $handler, Block $block, Category $category)
    {

        if ($block = $handler->process($request, $page)) :

            return redirect()->route('blocks.catalog.category.edit', ['page' => $page, 'category' => $category, 'block' => $block])->with('message', __( 'Сохранено' ));

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
    public function edit(Request $request, Pages $page, Category $category, Block $block)
    {

        $templates = $this->blocksTemplates();
        $fields = $this->blocksFieldsArray($templates, $block->component);

        return view('blocks.form', [
            'page' => $page,
            'item' => $block,
            'templates' => $templates,
            'fields' => $fields,
            'category' => $category,
        ]);

    }

    /**
     * @param BlocksRequest $request
     * @param StoreBlocksHandler $handler
     * @param Pages $page
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BlocksRequest $request, StoreBlocksHandler $handler, Pages $page, Category $category, Block $block)
    {

        if ($block = $handler->process($request, $page, $block)) :

            return redirect()->route('blocks.catalog.category.edit', ['page' => $page, 'category' => $category, 'block' => $block])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pages $page, Category $category, Block $block)
    {

        if ($block->delete()) :

            $this->imageRemove($block, 'blocks');

            return redirect()->route('blocks.catalog.category.index', ['page' => $page, 'category' => $category]);

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

}
