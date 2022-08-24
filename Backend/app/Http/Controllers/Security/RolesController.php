<?php

namespace Backend\Http\Controllers\Security;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Profile\StoreProfileHandler;
use Backend\Http\Handlers\Security\StoreRoleHandler;
use Backend\Http\Requests\Profile\ProfileRequest;
use Backend\Http\Requests\Security\RoleRequest;
use Backend\Models\Permission;
use Backend\Models\Profile\User;
use Backend\Models\Role;
use Backend\Models\Roles;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RolesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {

        return view('security.roles.index', [
            'items' => Role::paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Role $role)
    {
        return view('security.roles.form', [
            'model' => $role,
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(RoleRequest $request, StoreRoleHandler $handler, Role $role)
    {
        if ($role = $handler->process($request)) :

            return redirect()->route('security.roles.edit', $role)->with('message', __('Сохранено'));

        endif;

        return back()->withErrors($handler->getErrors());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Role $role)
    {
        return view('security.roles.form', [
            'model' => $role,
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(RoleRequest $request, StoreRoleHandler $handler, Role $role)
    {
        if ($role = $handler->process($request, $role)) :

            return redirect()->route('security.roles.edit', $role)->with('message', __('Сохранено'));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Role $role)
    {
        if ($role->delete()) :

            return redirect()->route('security.roles.index');

        endif;

        return back()->withErrors([
            __('Не удалось удалить запись')
        ]);
    }
}
