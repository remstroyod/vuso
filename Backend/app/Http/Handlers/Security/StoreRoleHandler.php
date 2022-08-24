<?php

namespace Backend\Http\Handlers\Security;

use Backend\Http\Handlers\BaseHandler;
use Backend\Http\Requests\Security\RoleRequest;
use Backend\Models\Role;
use Illuminate\Support\Str;
use Throwable;

class StoreRoleHandler extends BaseHandler
{

    /**
     * @param RoleRequest $request
     * @param Role|null $role
     * @return Role|null
     */
    public function process(RoleRequest $request, Role $role = null): ?Role
    {
        try {
            if (!$role) {
                $role = new Role();
            }

            if (empty($request->input('slug'))) :
                $request->merge([
                    'slug' => Str::slug($request->input('name'), '_')
                ]);
            endif;

            $role->fill($request->all());
            $role->save($request->all());

            $role->permissions()->sync($request->input('permissions'));

            return $role;
        } catch (Throwable $e) {
            $this->setErrors($e->getMessage());
            return null;
        }
    }

}
