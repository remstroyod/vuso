<?php

namespace Backend\Http\Handlers\Contacts;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Contacts\OfficesRequest;
use Backend\Models\About\Awards;
use Backend\Models\Contacts\Offices;
use Backend\Models\Pages;
use Illuminate\Support\Facades\Gate;

class StoreContactsOfficesHandler extends BaseHandler
{

    /**
     * @param OfficesRequest $request
     * @param Offices|null $offices
     * @return Offices|null
     */
    public function process(OfficesRequest $request, Offices $offices = null): ?Offices
    {

        try {

            if (!$offices) :
                $offices = new Offices();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('contacts'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $offices->fill($request->all());

            $offices->save($request->all());

            return $offices;

        } catch (\Throwable $e) {

            $this->setErrors(__( 'Не удалось сохранить запись' ));
            return null;

        }

    }

}
