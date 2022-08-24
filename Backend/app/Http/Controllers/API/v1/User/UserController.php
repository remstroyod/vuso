<?php

namespace Backend\Http\Controllers\API\v1\User;

use Backend\Http\Controllers\Controller;
use Backend\Http\Resources\API\v1\User\UserResource;
use Backend\Models\Profile\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
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

        if(!$user)
        {

            return response()->json([
                'data' => [],
                'message' => 'User Not Found'
            ], 403);
        }

        return UserResource::make($user);

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
    public function findUser(Request $request)
    {

        if( $request->missing('field') || $request->missing('value') )
        {

            return response()->json([
                'status' => false,
                'message' => 'Required Parameters not Passed'
            ], 403);

        }

        $field = $request->input('field');
        $value = $request->input('value');

        $user = User::whereHas('detail', function (Builder $query) use ( $field, $value ) {
            $query->where($field, 'like', '%'.$value.'%');
        })->first();

        if( !$user )
        {
            return response()->json([
                'status' => false,
                'message' => 'User is not found'
            ], 403);
        }

        return UserResource::make($user);

    }

}
