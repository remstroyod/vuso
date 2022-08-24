<?php

namespace Frontend\Http\Controllers;

use Frontend\Models\ApiUser;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

class ApiUserController extends Controller
{

    use HasApiTokens;
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
     * @param  \Frontend\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function show(ApiUser $apiUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Frontend\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiUser $apiUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Frontend\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiUser $apiUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Frontend\Models\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiUser $apiUser)
    {
        //
    }
}
