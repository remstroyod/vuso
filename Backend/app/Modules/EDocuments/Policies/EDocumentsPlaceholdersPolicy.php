<?php

namespace Backend\Modules\EDocuments\Policies;

use Backend\Models\Profile\User;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EDocumentsPlaceholdersPolicy
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
     * @param EDocumentsPlaceholders $placeholder
     * @return Response
     */
    public function view(User $user, EDocumentsPlaceholders $placeholder)
    {
        return ($user->can('modules_edocuments_placeholders_access')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function create(User $user)
    {
        return ($user->can('modules_edocuments_placeholders_create')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function update(User $user)
    {

        return ($user->can('modules_edocuments_placeholders_update')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param EDocumentsPlaceholders $placeholder
     * @return Response
     */
    public function delete(User $user, EDocumentsPlaceholders $placeholder)
    {
        return ($user->can('modules_edocuments_placeholders_destroy')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param EDocumentsPlaceholders $document
     * @return void
     */
    public function restore(User $user, EDocumentsPlaceholders $placeholder)
    {
        //
    }

    /**
     * @param User $user
     * @param EDocumentsPlaceholders $placeholder
     * @return void
     */
    public function forceDelete(User $user, EDocumentsPlaceholders $placeholder)
    {
        //
    }
}
