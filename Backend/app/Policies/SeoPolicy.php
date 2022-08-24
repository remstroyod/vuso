<?php

namespace Backend\Policies;

use Backend\Models\Profile\User;
use Backend\Models\Seo;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SeoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param \Backend\Models\Profile\User $user
     * @param \Backend\Models\Seo $seo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Seo $seo)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \Backend\Models\Profile\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \Backend\Models\Profile\User $user
     * @param \Backend\Models\Seo $seo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Seo $seo)
    {
        return ($user->can('seo_update')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

}
