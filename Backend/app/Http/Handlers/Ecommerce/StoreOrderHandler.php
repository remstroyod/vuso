<?php

namespace Backend\Http\Handlers\Ecommerce;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Contacts\CountriesRequest;
use Backend\Models\Contacts\Countries;
use Backend\Models\Ecommerce\Order;
use Backend\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoreOrderHandler extends BaseHandler
{

    /**
     * @param CountriesRequest $request
     * @param Countries|null $countries
     * @return Countries|null
     */
    public function process(Request $request, Order $order = null): ?Order
    {

        try {

            if (!$order) :
                $order = new Order();
                $response = Gate::inspect('create', Order::class);
            else:
                $response = Gate::inspect('update', Order::class);
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $order->fill($request->all());

            $order->save($request->all());

            $order->history()->create($request->only('status'));

            return $order;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
