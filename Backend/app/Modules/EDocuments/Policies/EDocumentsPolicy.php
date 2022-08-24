<?php

namespace Backend\Modules\EDocuments\Policies;

use Backend\Models\Profile\User;
use Backend\Modules\EDocuments\Models\EDocuments;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EDocumentsPolicy
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
     * @param EDocuments $document
     * @return Response
     */
    public function view(User $user, EDocuments $document)
    {
        return ($user->can('modules_edocuments_type_access')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function create(User $user)
    {
        return ($user->can('modules_edocuments_type_create')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function update(User $user)
    {

        return ($user->can('modules_edocuments_type_update')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param EDocuments $document
     * @return Response
     */
    public function delete(User $user, EDocuments $document)
    {
        return ($user->can('modules_edocuments_type_destroy')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param EDocuments $document
     * @return void
     */
    public function restore(User $user, EDocuments $document)
    {
        //
    }

    /**
     * @param User $user
     * @param EDocuments $document
     * @return void
     */
    public function forceDelete(User $user, EDocuments $document)
    {
        //
    }
}
