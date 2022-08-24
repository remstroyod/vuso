<?php

namespace Backend\Services\User;

use Backend\Models\Profile\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserService
{

    public function __construct()
    {

        //

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //

    }

    /**
     * @param Request $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function findUser($request)
    {

        if( $request->missing('field') || $request->missing('value') )
        {

            throw new \Exception(__('Required Parameters not Passed')); 

        }

        $field = $request->input('field');
        $value = $request->input('value');

        $user = User::whereHas('detail', function (Builder $query) use ( $field, $value ) {
            $query->where($field, 'like', '%'.$value.'%');
        })->first();

        if( !$user )
        {
            throw new \Exception(__('Пользователь не найден')); 
        }

        return $user;
    }

}
