<?php

namespace Backend\Policies;

use Backend\Models\Profile\User;
use Backend\Models\Sales;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SalesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Sales  $sales
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Sales $sales)
    {
        return ($user->can('sales_access')|| $user->hasRole('admin'))
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
        return ($user->can('sales_create')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Sales  $sales
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return ($user->can('sales_update')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Sales  $sales
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Sales $sales)
    {
        return ($user->can('sales_destroy')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Sales  $sales
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Sales $sales)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Sales  $sales
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Sales $sales)
    {
        //
    }
}
