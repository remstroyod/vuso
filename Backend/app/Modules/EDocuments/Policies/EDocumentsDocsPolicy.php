<?php

namespace Backend\Modules\EDocuments\Policies;

use Backend\Models\Profile\User;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EDocumentsDocsPolicy
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
     * @param EDocumentsDocs $document
     * @return Response
     */
    public function view(User $user, EDocumentsDocs $document)
    {
        return ($user->can('modules_edocuments_documents_access')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function create(User $user)
    {
        return ($user->can('modules_edocuments_documents_create')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function update(User $user)
    {

        return ($user->can('modules_edocuments_documents_update')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param EDocumentsDocs $document
     * @return Response
     */
    public function delete(User $user, EDocumentsDocs $document)
    {
        return ($user->can('modules_edocuments_documents_destroy')|| $user->hasRole('admin'))
            ? Response::allow()
            : Response::deny(__('Нет доступа'));
    }

    /**
     * @param User $user
     * @param EDocumentsDocs $document
     * @return void
     */
    public function restore(User $user, EDocumentsDocs $document)
    {
        //
    }

    /**
     * @param User $user
     * @param EDocumentsDocs $document
     * @return void
     */
    public function forceDelete(User $user, EDocumentsDocs $document)
    {
        //
    }
}
