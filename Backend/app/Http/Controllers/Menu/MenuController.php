<?php

namespace Backend\Http\Controllers\Menu;

use Backend\Enums\MenuEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Menu\StoreMenuHandler;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\Menu\MenuRequest;
use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\Menu\Menu;
use Backend\Models\Pages;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:menu_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Menu $menu)
    {

        return view('menu.index', [
            'items' => $menu->paginate(10),
        ]);

    }

    /**
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Menu $menu)
    {

        $wrapper = MenuEnum::$name;

        return view('menu.form', [
            'model' => $menu,
            'wrapper' => $wrapper,
        ]);

    }

    /**
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Menu $menu)
    {

        $wrapper = MenuEnum::$name;

        return view('menu.form', [
            'model' => $menu,
            'wrapper' => $wrapper,
        ]);

    }

    /**
     * @param MenuRequest $request
     * @param StoreMenuHandler $handler
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuRequest $request, StoreMenuHandler $handler, Menu $menu)
    {

        if ($menu = $handler->process($request)) :

            return redirect()->route('menu.edit', $menu)->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param MenuRequest $request
     * @param StoreMenuHandler $handler
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuRequest $request, StoreMenuHandler $handler, Menu $menu)
    {

        if ($menu = $handler->process($request, $menu)) :

            return redirect()->route('menu.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Menu $menu)
    {

        if ($menu->delete()) :
            return redirect()->route('menu.index');
        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }
}
