<?php

namespace Backend\Http\Controllers\Users\Profile;

use Backend\Http\Controllers\Controller;
use Backend\Http\Requests\Profile\SocialsRequest;
use Backend\Models\Profile\User;
use Backend\Models\Profile\UserSocials;
use Exception;
use Illuminate\Http\Request;

class SocialsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {

        return view('profile.socials.index', [
            'user' => $user,
            'items' => $user->socials()->paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, UserSocials $socials)
    {

        return view('profile.socials.form', [
            'user' => $user,
            'model' => $socials,
            'icons' => $socials->icons->labels()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialsRequest $request, User $user, UserSocials $socials)
    {

        $request->merge([
            'user_id' => $user->id
        ]);

        $socials->fill($request->input());

        if ($socials->save()) {

            return redirect()->route('profile.socials.edit', ['user' => $user, 'socials' => $socials])->with('message', __( 'Сохранено' ));

        }
        return back()->withErrors(['Не удалось сохранить запись']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, UserSocials $socials)
    {

        return view('profile.socials.form', [
            'user' => $user,
            'model' => $socials,
            'icons' => $socials->icons->labels()
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UserSocials $socials)
    {

        if ($socials->delete()) :

            return redirect()->route('profile.socials.index', $user);

        endif;

        return back()->withErrors([
            __( 'Не удалось удалить запись' )
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocialsRequest $request, User $user, UserSocials $socials)
    {

        try {

            $socials->update($request->all());
            return redirect()->route('profile.socials.edit', ['user' => $user, 'socials' => $socials])->with('message', __( 'Сохранено' ));

        }catch (Exception $e) {

            return back()->withErrors($e->getMessage());

        }

    }


}
