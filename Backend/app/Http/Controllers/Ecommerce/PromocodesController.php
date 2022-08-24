<?php

namespace Backend\Http\Controllers\Ecommerce;

use Backend\Enums\OrderStatusEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Ecommerce\StoreOrderHandler;
use Backend\Http\Handlers\Ecommerce\StorePromocodeHandler;
use Backend\Http\Handlers\Ecommerce\UpdatePromocodeHandler;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\Ecommerce\PromocodeRequest;
use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\Catalog\Product;
use Backend\Models\Ecommerce\Order;
use Backend\Models\Ecommerce\OrderHistory;
use Backend\Models\Ecommerce\Promocode;
use Backend\Models\Ecommerce\PromocodeOnlyProduct;
use Backend\Models\Pages;
use Gabievi\Promocodes\Facades\Promocodes;
use Illuminate\Http\Request;

class PromocodesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ecommerce_promocodes_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Promocode $promocode)
    {

        return view('ecommerce.promocodes.index', [
            'items' => $promocode->paginate(10),
        ]);

    }

    /**
     * @param Request $request
     * @param Promocode $promocode
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Promocode $promocode, Product $products)
    {

        return view('ecommerce.promocodes.form', [
            'model' => $promocode,
            'products' => $products->all(),
        ]);

    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Product $product)
    {

        return view('ecommerce.promocodes.form', [
            'products' => $product->all(),
        ]);

    }

    /**
     * @param PromocodeRequest $request
     * @param StorePromocodeHandler $handler
     * @param Promocode $promocode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PromocodeRequest $request, UpdatePromocodeHandler $handler, Promocode $promocode)
    {

        if ($promocode = $handler->process($request, $promocode)) :

            return redirect()->route('ecommerce.promocodes.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param PromocodeRequest $request
     * @param StorePromocodeHandler $handler
     * @param Promocode $promocode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PromocodeRequest $request, StorePromocodeHandler $handler)
    {

        if ($handler->process($request)) :

            return redirect()->route('ecommerce.promocodes.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Promocode $promocode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Promocode $promocode): \Illuminate\Http\RedirectResponse
    {

        if ($promocode->delete()) :

            return redirect()->route('ecommerce.promocodes.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

}
