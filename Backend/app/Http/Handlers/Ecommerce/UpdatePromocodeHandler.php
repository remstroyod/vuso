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

class UpdatePromocodeHandler extends BaseHandler
{

    /**
     * @param PromocodeRequest $request
     * @param Promocode|null $promocode
     * @return Promocode|null
     */
    public function process(PromocodeRequest $request, Promocode $promocode = null): ?Promocode
    {

        try {

            $response = Gate::inspect('update', Promocode::class);

            if (!$response->allowed())
            {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $request->merge([
                'data' => [
                    'reward_type' => $request->input('reward_type')
                ]
            ]);

            $promocode->fill($request->all());
            $promocode->save($request->all());
            $promocode->products()->sync($request->input('products'));

            return $promocode;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
