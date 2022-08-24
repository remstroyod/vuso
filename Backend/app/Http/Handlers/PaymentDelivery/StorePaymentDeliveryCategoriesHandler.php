<?php

namespace Backend\Http\Handlers\PaymentDelivery;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Partners\PartnersCategoriesRequest;
use Backend\Http\Requests\PaymentDelivery\PaymentDeliveryCategoriesRequest;
use Backend\Models\Pages;
use Backend\Models\PaymentDelivery\Categories;
use Illuminate\Support\Facades\Gate;

class StorePaymentDeliveryCategoriesHandler extends BaseHandler
{

    /**
     * @param PartnersCategoriesRequest $request
     * @param Categories|null $categories
     * @return Categories|null
     */
    public function process(PaymentDeliveryCategoriesRequest $request, Categories $categories = null): ?Categories
    {

        try {

            if (!$categories) :
                $categories = new Categories();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('payment_delivery'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $categories->fill($request->all());

            $categories->save($request->all());

            return $categories;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
