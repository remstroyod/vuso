<?php

namespace Backend\Http\Handlers\Ecommerce;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Contacts\CountriesRequest;
use Backend\Http\Requests\Ecommerce\PromocodeRequest;
use Backend\Models\Contacts\Countries;
use Backend\Models\Ecommerce\Order;
use Backend\Models\Ecommerce\Promocode;
use Backend\Models\Pages;
use Gabievi\Promocodes\Facades\Promocodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StorePromocodeHandler extends BaseHandler
{

    /**
     * @param PromocodeRequest $request
     * @param Promocode|null $promocode
     * @return Promocode|null
     */
    public function process(PromocodeRequest $request)
    {

        try {

            $response = Gate::inspect('create', Promocode::class);

            if (!$response->allowed())
            {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $promocode = new Promocode();

            $request->merge([
                'data' => [
                    'reward_type' => $request->input('reward_type')
                ]
            ]);

            $promocode->fill($request->all());

            $promocode = Promocodes::create(
                $amount = $request->input('amount'),
                $reward = $request->input('reward'),
                [
                    'reward_type' => $request->input('reward_type')
                ],
                $expires_in = $request->input('expires_at'),
                $quantity = $request->input('quantity'),
                $is_disposable = $request->input('is_disposable')
            );

            foreach ( $promocode as $model )
            {
                $model = Promocode::where('code', $model['code'])->first();
                $model->update(['name' => $request->input('name')]);
                $model->products()->sync($request->input('products'));
            }

            return $promocode;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
