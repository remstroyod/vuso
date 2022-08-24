<?php

namespace Backend\Http\Handlers\Profile;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Articles\ArticlesRequest;
use Backend\Http\Requests\Profile\ProfileRequest;
use Backend\Models\Articles\Articles;
use Backend\Models\Profile\User;
use Backend\Models\Profile\UserDetail;
use Backend\Models\Roles;
use Backend\Traits\ImageUploadTrait;

class StoreProfileHandler extends BaseHandler
{

    use ImageUploadTrait;

    /**
     * @param ArticlesRequest $request
     * @param Articles|null $articles
     * @return Articles|null
     */
    public function process(ProfileRequest $request, User $user = null): ?User
    {

        try {

            if ( ! $user ) $user = new User();

            $user->fill($request->all());
            $user->save($request->all());

            $this->storeUserDetail($request, $user);
            $this->storeRoleUpdate($request, $user);

            return $user;

        } catch (\Throwable $e) {

            $this->setErrors($e->getMessage());
            return null;

        }

    }

    /**
     * @param ProfileRequest $request
     * @param User $user
     * @return void
     */
    protected function storeUserDetail(ProfileRequest $request, User $user): void
    {
        if ( ! $detail = $user->detail ):
            $detail = (new UserDetail())->user()->associate($user);
        endif;

        $detail->fill($request->all());

        if ( ! $detail->save() ) :
            throw new \LogicException('Failed to store clinic details');
        endif;

        /**
         * Upload Image
         */
        if( $request->hasFile('image') ) :
            $detail->update(['image' => $this->imageUpload($detail, 'user/' . $user->id . '/')]);
        endif;

        /**
         * Upload Avatar
         */
        if( $request->hasFile('avatar') ) :
            $detail->update(['avatar' => $this->imageUpload($detail, 'user/' . $user->id . '/', 'avatar')]);
        endif;

        /**
         * Remove Image
         */
        if ($request->input('flush_image')) :

            $this->imageRemove($detail, 'user'. $user->id . '/');
            $detail->update(['image' => null]);

        endif;

        /**
         * Remove Avatar
         */
        if ($request->input('flush_avatar')) :

            $this->imageRemove($detail, 'user'. $user->id . '/', 'avatar');
            $detail->update(['avatar' => null]);

        endif;

    }

    /**
     * @param ProfileRequest $request
     * @param User $user
     * @param Roles $roles
     * @return void
     */
    protected function storeRoleUpdate(ProfileRequest $request, User $user): void
    {

        Roles::where('user_id', $user->id)->update(['role_id' => $request->role]);

    }

}
