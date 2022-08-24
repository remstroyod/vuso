<?php

namespace Frontend\Http\Controllers\API\v1\User;

use Frontend\Http\Controllers\Controller;
use Frontend\Http\Requests\Auth\PhoneRequest;
use Frontend\Http\Requests\Auth\SmsRequest;
use Frontend\Http\Requests\OtpRequest;
use Frontend\Http\Resources\User\SmsResource;
use Frontend\Traits\SendSMSTrait;
use Illuminate\Http\Request;
use Frontend\Http\Resources\User\AuthResource;

 class AuthController extends Controller
{

    use SendSMSTrait;
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

        return 1;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
     * @param SmsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request)
    {

        return response()->json([
            'status' => true,
            'message' => __( 'Вы успешно авторизовались' ),
            'data' => $request->user()->load('detail'),
        ], 200);

    }

    /**
     * @param Request $request
     * @return void
     */
    public function sendSms(PhoneRequest $request)
    {

        $user = new \Frontend\Http\Controllers\Auth\AuthController();
        $user = $user->authPhone($request);

        return response()->json([
            'data' => new SmsResource($user),
            'status' => true,
            'message' => 'User Send SMS Success!'
        ], 200);

    }

    /**
     * @param SmsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authPhoneCode(SmsRequest $request)
    {

        $user = new \Frontend\Http\Controllers\Auth\AuthController();

        return $user->authPhoneCode($request);

    }

    /**
     * @param OtpRequest $request
     * @return void
     */
    public function sendOtp(OtpRequest $request)
    {

        return $this->otp($request);

    }

    public function resendOtp(Request $request){

        $user = $request->user();
        
        $otp = $user->otp;

        $phone = $user->detail->phone;


        $request->merge([
            'code' => $otp,
            'phone' => $phone,
        ]);

        return $this->otp($request);
    }
}
