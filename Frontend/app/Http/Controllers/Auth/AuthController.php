<?php

namespace Frontend\Http\Controllers\Auth;

use Frontend\Http\Controllers\Controller;
use Frontend\Http\Requests\Auth\PasswordCheckRequest;
use Frontend\Http\Requests\Auth\PasswordStoreRequest;
use Frontend\Http\Requests\Auth\PhoneRequest;
use Frontend\Http\Requests\Auth\SmsRequest;
use Frontend\Http\Resources\User\AuthResource;
use Frontend\Models\Profile\User;
use Frontend\Models\Profile\UserDetail;
use Frontend\Models\Profile\UserProvider;
use Frontend\Services\ConnectionOneCService;
use Frontend\Traits\SendSMSTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    use SendSMSTrait;

    /**
     * @var string
     */
    protected $redirectTo = '/profile';

    public function __construct()
    {

    }

    /**
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {

        Session::put('auth.back', url()->previous());

        return Socialite::driver($provider)->redirect();

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request, $provider)
    {

        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        if(Session::has('auth.back'))
        {
            return redirect(Session::get('auth.back'));
        }

        return redirect($this->redirectTo);

    }

    /**
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider): User
    {

        $authUser = UserProvider::where('provider_id', $user->id)->first();

        if (isset($authUser->user))
            return $authUser->user;

        if( $user->email )
        {
            $authUser = User::where('email', $user->email)->first();
            if( $authUser )
                return $authUser;
        }

        /**
         * Create User
         */
        $created_user = $this->createUser($user);

        if( $created_user )
        {

            if( $provider == 'telegram' )
            {
                $first_name = $user->user['first_name'];
                $last_name = $user->user['last_name'];
                $avatar = $user->user['photo_url'];
            }

            if( $provider == 'facebook' || $provider == 'google' )
            {
                $name = explode(' ', $user->user['name']);
                $first_name = (array_key_exists(0, $name)) ? $name[0] : '';
                $last_name = (array_key_exists(1, $name)) ? $name[1] : '';
                $avatar = $user->avatar;
            }

            if( $provider == 'apple' )
            {

            }

            /**
             * Save Provider
             */
            $this->saveProvider($created_user->id, $provider, $user->id);

            /**
             * Save User Detail
             */
            $detail = new UserDetail([
                'user_id' => $created_user->id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'avatar' => $avatar,
            ]);

            $detail->save();

        }

        return $created_user;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authPhone(PhoneRequest $request)
    {

        $phone = $request->input('phone');

        $via = $request->input('via', null);

        $user = $this->sendSms($phone, $via);

        if( $request->is('api/*'))
        {

            return $user;

        }else{

            return response()->json([
                'status' => true,
                'message' => view('forms.auth.auth-sms-code', ['phone' => $phone, 'user' => $user])->render(),
            ], 200);

        }

    }

    /**
     * @param $phone
     * @return int|string|void
     */
    public function sendSms($phone, $via = null)
    {
        $trimPhone = Str::onlyNumber($phone);

        $userDetail = UserDetail::where('phone', $trimPhone)->first();

        if( $userDetail )
        {

            $user = $userDetail->user;

        }else{

            $user = new User();
            $user->name = $trimPhone;
            $user->save();
            $user->setRolesDefault();
            $user->detail()->create([
                'phone' => $trimPhone
            ]);

        }

        $this->send($user, $via);

        return $user;

    }

    /**
     * @param SmsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authPhoneCode(SmsRequest $request)
    {
        $trimPhone = Str::onlyNumber($request->input('phone'));
        /**
         * Find User by Phone
         */
        $user = UserDetail::where('phone', $trimPhone)->first();

        /**
         * is User true
         */
        if( isset($user->user->id) )
        {

            $sms_code = $user->user->sms_code;

            if( $sms_code == $request->input('sms_code') )
            {

                if( Auth::loginUsingId($user->user->id) )
                {

                    Auth::user()->update(['sms_code' => null]);

                   $importOneC = new ConnectionOneCService();
                   $importOneC->createInsuranceDocs($user);

                    return response()->json([
                        'status' => true,
                        'message' => __( 'Вы успешно авторизовались' ),
                        'data' => new AuthResource($user),
                        'url' => $this->redirectTo,
                    ], 200);

                }else{

                    return response()->json([
                        'status' => false,
                        'errors' => [
                            'sms_code' => [
                                0 => 'Ошибка авторизации'
                            ]
                        ],
                        'message' => '',
                    ], 401);

                }

            }else{

                return response()->json([
                    'status' => false,
                    'errors' => [
                        'sms_code' => [
                            0 => 'Неверный код'
                        ]
                    ],
                    'message' => '',
                ], 401);

            }

        }else{

            return response()->json([
                'status' => false,
                'errors' => [
                    'sms_code' => [
                        'Пользователь не найден'
                    ]
                ],
                'message' => '',
            ], 401);

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authEnterPasswordForm(Request $request)
    {

        $user = User::find($request->user);

        if( $user )
        {

            return response()->json([
                'status' => true,
                'message' => view('forms.auth.auth-enter-password', ['phone' => $request->phone, 'user' => $user])->render(),
            ], 200);

        }else{

            return response()->json([
                'status' => false,
                'message' => __( 'Пользователь с таким телефоном не найден' ),
            ], 401);

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authCreatePasswordForm(Request $request)
    {

        $user = User::find($request->user);

        if( $user )
        {

            return response()->json([
                'status' => true,
                'message' => view('forms.auth.auth-create-password', ['phone' => $request->phone, 'user' => $user])->render(),
            ], 200);

        }else{

            return response()->json([
                'status' => false,
                'message' => __( 'Пользователь с таким телефоном не найден' ),
            ], 401);

        }

    }

    /**
     * @param PasswordStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authCreatePasswordStore(PasswordStoreRequest $request)
    {

        $user = User::find($request->user);
        $user->password = Hash::make($request->password);
        $user->save();

        if( Auth::loginUsingId($request->user) )
        {

            return response()->json([
                'status' => true,
                'message' => __( 'Вы успешно авторизовались' ),
                'url' => $this->redirectTo,
            ], 200);

        }else{

            return response()->json([
                'status' => false,
                'message' => __( 'Ошибка авторизации' ),
            ], 401);

        }

    }

    public function authCreatePasswordViaPhone(PasswordStoreRequest $request)
    {
        try {
        
            $trimPhone = Str::onlyNumber($request->phone);
        
            $userDetail = UserDetail::where('phone', $trimPhone)->firstOrFail();

            $user = $userDetail->user;
        
            $user->password = Hash::make($request->password);
        
            $user->save();

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 422);

        }

        return response()->json([
            'status' => true,
            'message' => __( 'Вы успешно добавили пароль' ),
        ], 200);
    }

    /**
     * @param PasswordCheckRequest $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function authEnterPasswordCheck(PasswordCheckRequest $request)
    {
        if (isset($request->phone) && !isset($request->user)) {
            $trimPhone = Str::onlyNumber($request->input('phone'));
            /**
             * Find User by Phone
             */
            $user = UserDetail::where('phone', $trimPhone)->first();

            $request->user = $user->user->id;
        }

        if (Auth::attempt(['id' => $request->user, 'password' => $request->password]))
        {

            return response()->json([
                'status' => true,
                'message' => __( 'Вы успешно авторизовались' ),
                'url' => $this->redirectTo,
            ], 200);

        }else{

            return response()->json([
                'status' => false,
                'errors' => [
                    'password' => [
                        0 => 'Неверный пароль',
                    ]
                ],
                'message' => '',
            ], 401);

        }

    }

    /**
     * @param $user
     * @param $provider
     * @param $providerid
     * @return void
     */
    public function saveProvider($user, $provider, $providerid)
    {

        try {

            UserProvider::updateOrCreate(
                [
                    'provider_id' => $providerid
                ],
                [
                'user_id' => $user,
                'provider' => $provider,
                'provider_id' => $providerid,
            ]);

        } catch (\Throwable $e) {

            return $e->getMessage();

        }

    }

    /**
     * @param $user
     * @return null
     */
    public function createUser($user)
    {

        try {

            $data = User::create([
                'name' => (empty($user->nickname)) ? $user->email : Str::slug(Str::ascii($user->nickname), '_'),
                'email' => $user->email,
            ])->setRolesDefault();

            return $data;

        } catch (\Throwable $e) {

            return $e->getMessage();

        }

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        session()->regenerate();
        
        return response()->json(
            [
                "token" => csrf_token()
            ],
            200);
    }

    public function hasPassword()
    {

        $trimPhone = Str::onlyNumber(request()->phone);

        $userDetail = UserDetail::where('phone', $trimPhone)->firstOrFail();

        $user = $userDetail->user;

        return response()->json([
            'status' => true,
            'hasPassword' => !empty($user->password),
        ], 200);
    }

}
