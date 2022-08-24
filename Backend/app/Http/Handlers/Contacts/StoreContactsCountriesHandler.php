<?php

namespace Backend\Http\Handlers\Contacts;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Contacts\CountriesRequest;
use Backend\Models\Contacts\Countries;
use Backend\Models\Pages;
use Illuminate\Support\Facades\Gate;

class StoreContactsCountriesHandler extends BaseHandler
{

    /**
     * @param CountriesRequest $request
     * @param Countries|null $countries
     * @return Countries|null
     */
    public function process(CountriesRequest $request, Countries $countries = null): ?Countries
    {

        try {

            if (!$countries) :
                $countries = new Countries();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('contacts'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $countries->fill($request->all());

            $countries->save($request->all());

            return $countries;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
