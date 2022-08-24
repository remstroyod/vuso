<?php

namespace Backend\Http\Controllers\Ecommerce;

use Backend\Enums\OrderStatusEnum;
use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Ecommerce\StoreOrderHandler;
use Backend\Http\Handlers\StorePagesHandler;
use Backend\Http\Requests\PagesRequest;
use Backend\Http\Requests\SeoRequest;
use Backend\Models\Ecommerce\Order;
use Backend\Models\Ecommerce\OrderHistory;
use Backend\Models\Pages;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    /**
     * @var string
     */
    protected $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';

    /**
     * @var string
     */
    protected $mask = '******';

    public function __construct()
    {
        $this->middleware('permission:ecommerce_orders_access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {

        $status = new OrderStatusEnum();

        return view('ecommerce.orders.index', [
            'items' => $order->paginate(10),
            'status' => $status,
        ]);

    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Order $order)
    {

        $status = new OrderStatusEnum();

        return view('ecommerce.orders.form', [
            'model' => $order,
            'status' => $status->list(),
        ]);

    }

    /**
     * @param Request $request
     * @param StoreOrderHandler $handler
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, StoreOrderHandler $handler, Order $order)
    {

        if ($order = $handler->process($request, $order)) :

            return redirect()->route('ecommerce.order.index')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order): \Illuminate\Http\RedirectResponse
    {

        if ($order->delete()) :

            return redirect()->route('ecommerce.order.index');

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * @param Order $order
     * @param OrderHistory $history
     * @return void
     */
    public function history(Order $order)
    {

        $status = new OrderStatusEnum();

        return view('ecommerce.orders.history.index', [
            'model' => $order,
            'status' => $status,
        ]);

    }

    public function cancel(User $user, Docuemnt $document){
        return (new \Frontend\Http\Controllers\PaymentController())->orderCancel($request);
    }

    /**
     * @param $id
     * @return string
     */
    public function generate()
    {
        $characters = $this->characters;
        $mask = $this->mask;
        $numer = '';
        $random = [];
        $length = substr_count($mask, '*');

        for ($i = 1; $i <= $length; $i++) {
            $character = $characters[rand(0, strlen($characters) - 1)];
            $random[] = $character;
        }

        shuffle($random);
        $length = count($random);

        for ($i = 0; $i < $length; $i++) {
            $mask = preg_replace('/\*/', $random[$i], $mask, 1);
        }

        $numer .= $mask;

        return $numer;
    }

}
