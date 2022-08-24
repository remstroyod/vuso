<?php

namespace Backend\Http\Controllers\Users\Profile;

use Backend\Http\Controllers\Controller;
use Backend\Http\Handlers\Profile\StoreProfileHandler;
use Backend\Http\Requests\Profile\PasswordRequest;
use Backend\Http\Requests\Profile\ProfileRequest;
use Backend\Models\Profile\User;
use Backend\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('profile.index', [
            'user' => auth()->user()
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        return view('profile.form', [
            'user' => auth()->user(),
            'roles' => Role::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, StoreProfileHandler $handler)
    {

        if ($user = $handler->process($request, auth()->user())) :

            return redirect()->route('users.profile.edit')->with('message', __( 'Сохранено' ));

        endif;

        return back()->withErrors($handler->getErrors());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function password()
    {

        return view('profile.password.form', [
            'user' => auth()->user(),
        ]);

    }

    /**
     * @param PasswordRequest $request
     * @param User $user
     * @return void
     */
    public function passwordUpdate(PasswordRequest $request)
    {

        try {

            $user = auth()->user();
            $user->update(['password' => $request->password]);

            return redirect()->route('logout');

        }catch (Exception $e) {

            return back()->withErrors($e->getMessage());

        }

    }
}
