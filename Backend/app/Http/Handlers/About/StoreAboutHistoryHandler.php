<?php

namespace Backend\Http\Handlers\About;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\About\AwardsRequest;
use Backend\Http\Requests\About\HistoryRequest;
use Backend\Models\About\Awards;
use Backend\Models\About\History;
use Backend\Models\Pages;
use Illuminate\Support\Facades\Gate;

class StoreAboutHistoryHandler extends BaseHandler
{

    /**
     * @param AwardsRequest $request
     * @param Awards|null $awards
     * @return Awards|null
     */
    public function process(HistoryRequest $request, History $history = null): ?History
    {

        try {

            if (!$history) :
                $history = new History();
                $response = Gate::inspect('create', Pages::class);
            else:
                $response = Gate::inspect('update', Pages::findOrFail('about'));
            endif;

            if (!$response->allowed()) {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $history->fill($request->all());

            $history->save($request->all());

            return $history;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
