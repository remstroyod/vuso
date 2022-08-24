<?php

namespace Backend\Modules\PayHub\Policies;

use Backend\Models\Profile\User;
use Backend\Modules\PayHub\Models\PayHubSystem;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PayHubSystemsPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return void
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * @param User $user
     * @param PayHubSystem $system
     * @return Response
     */
    public function view(User $user, PayHubSystem $system)
    {
        return ($user->can('modules_payhub_systems_access')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function create(User $user)
    {
        return ($user->can('modules_payhub_systems_create')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function update(User $user)
    {

        return ($user->can('modules_payhub_systems_update')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param PayHubSystem $system
     * @return Response
     */
    public function delete(User $user, PayHubSystem $system)
    {
        return ($user->can('modules_payhub_systems_destroy')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param PayHubSystem $system
     * @return void
     */
    public function restore(User $user, PayHubSystem $system)
    {
        //
    }

    /**
     * @param User $user
     * @param PayHubSystem $system
     * @return void
     */
    public function forceDelete(User $user, PayHubSystem $system)
    {
        //
    }
}
