<?php

namespace Backend\Policies;

use Backend\Models\Pages;
use Backend\Models\Profile\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PagesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Pages  $pages
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pages $pages)
    {
        return ($user->can('pages_access')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return ($user->can('pages_create')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Pages  $pages
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pages $pages)
    {

        return ($user->can('pages_update') || $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Pages  $pages
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pages $pages)
    {
        return ($user->can('pages_destroy')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

}
