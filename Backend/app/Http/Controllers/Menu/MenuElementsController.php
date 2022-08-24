<?php

namespace Backend\Http\Controllers\Menu;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Menu\StoreMenuElementsHandler;
use Backend\Http\Requests\Menu\MenuElementsRequest;
use Backend\Models\Menu\Menu;
use Backend\Models\Menu\MenuItem;
use Backend\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class MenuElementsController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Menu $menu)
    {

        return view('menu.elements.index', [
            'model' => $menu,
            'items' => $menu->items,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Menu $menu, MenuItem $element)
    {

        return view('menu.elements.form', [
            'model' => $menu,
            'item' => $element,
            'parents' => $menu->items,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuElementsRequest $request, Menu $menu, StoreMenuElementsHandler $handler, MenuItem $element)
    {

        if ($element = $handler->process($request, $menu)) :

            return redirect()->route('menu.elements.index', ['menu' => $menu])->with('message', __( 'Сохранено' ));

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
    public function edit(Request $request, Menu $menu, MenuItem $element)
    {

        return view('menu.elements.form', [
            'model' => $menu,
            'item' => $element,
            'parents' => $menu->items->whereNotIn('id', [$element->id]),
        ]);

    }

    /**
     * @param MenuElementsRequest $request
     * @param Menu $menu
     * @param StoreMenuElementsHandler $handler
     * @param MenuItem $element
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuElementsRequest $request, Menu $menu, StoreMenuElementsHandler $handler, MenuItem $element)
    {

        if ($element = $handler->process($request, $menu, $element)) :

            return redirect()->route('menu.elements.index', ['menu' => $menu])->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menu $menu, MenuItem $element)
    {

        if ($element->delete()) :

            $this->imageRemove($element, 'menu');

            return redirect()->route('menu.elements.index', ['menu' => $menu]);

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

}
