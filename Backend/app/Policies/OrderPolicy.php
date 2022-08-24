<?php

namespace Backend\Policies;

use Backend\Models\Ecommerce\Order;
use Backend\Models\Profile\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
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
     * @param  \Backend\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Order $order)
    {
        return ($user->can('ecommerce_orders_access')|| $user->hasRole('admin'))
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
        return ($user->can('ecommerce_orders_create')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return ($user->can('ecommerce_orders_update')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Order $order)
    {
        return ($user->can('ecommerce_orders_destroy')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Backend\Models\Profile\User  $user
     * @param  \Backend\Models\Order  $order
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
