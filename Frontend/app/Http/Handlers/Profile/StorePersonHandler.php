<?php

namespace Frontend\Http\Handlers\Profile;

use Backend\Http\Handlers\BaseHandler;
use Backend\Models\Log;
use Frontend\Http\Requests\Profile\PersonRequest;
use Frontend\Models\Profile\User;
use Jenssegers\Date\Date;

class StorePersonHandler extends BaseHandler
{

    /**
     * @param PersonRequest $request
     * @param User|null $awards
     * @return User|null
     */
    public function process(PersonRequest $request, User $user = null): ?User
    {

        try {

            /**
             * General
             */
            $user->fill($request->only(['email']));
            $user->update($request->all());

            /**
             * Detail
             */
            $user->detail->fill($request->all());
            $inputs = $request->except(['_token', 'email']);
            if (isset($inputs['birthday']))
                $inputs['birthday'] = Date::parse($inputs['birthday'])->format('Y-m-d');
            $user->detail()->update($inputs);

            return $user;

        } catch (\Throwable $e) {
            $this->setErrors($e->getMessage());
            return null;
        }

    }

}
