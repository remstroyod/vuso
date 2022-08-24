<?php

namespace Backend\Modules\PayHub\Http\Handlers;

use Backend\Http\Handlers\BaseHandler;
use Backend\Modules\PayHub\Http\Requests\PayHubSystemsRequest;
use Backend\Modules\PayHub\Models\PayHubSystem;
use Illuminate\Support\Facades\Gate;

class StorePayHubSystemsHandler extends BaseHandler
{

    /**
     * @param PayHubSystemsRequest $request
     * @param PayHubSystem|null $system
     * @return PayHubSystem|null
     */
    public function process(PayHubSystemsRequest $request, PayHubSystem $system = null): ?PayHubSystem
    {

        try {

            if (!$system) :
                $system = new PayHubSystem();
                $response = Gate::inspect('create', PayHubSystem::class);
            else:
                $response = Gate::inspect('update', PayHubSystem::class);
            endif;

            if (!$response->allowed())
            {
                return $this->setErrors(__('У вас недостаточно прав. Обратитесь к администратору.'));
            }

            $system->fill($request->all());

            $system->save($request->all());

            return $system;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

}
