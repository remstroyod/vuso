<?php
namespace Frontend\Traits;

use Frontend\Http\Requests\OtpRequest;
use Illuminate\Support\Facades\Http;

trait SendSMSTrait
{

    /**
     * @param $phone
     * @param int|null $code
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response|\Illuminate\Http\JsonResponse|string
     */
    private function api($phone, string $code = null, string $via = null)
    {

        if( empty( $code )) $code = rand(1000, 9999);

        try {

            $arr = [
                'text'                      => __( 'Код авторизации' ) .': ' . $code,
                'validityPeriod'            => 35,
                'validityPeriodTimeUnit'    => 'SECONDS'
            ];

            $data = [
                'scenarioKey'   => '017E5B74509E5E4A6907F9BDA3A7B737',
                'destinations'  => [
                    'to' => [
                        'phoneNumber' => $phone
                    ]
                ],
                //'viber'     => $arr,
                'sms'       => $arr,
            ];

            if(empty($via)){

                $data['viber'] = $arr;
            
            }


            $response = Http::withHeaders([
                'Authorization' => 'App 96581ff4184974eecbdcab087ba79680-3de02541-2ab4-4fb1-890c-c2f10683b476',
            ])->post('https://lzqmjr.api.infobip.com/omni/1/advanced', $data);

            $response->code = $code;

            return $response;

        } catch (\Throwable $e) {

            return $e->getMessage();

        }

    }

    /**
     * @param $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse
     */
    protected function send($user, $via = null)
    {

        $phone = $user->detail->phone;

        if( $phone )
        {

            $response = $this->api($phone, null, $via);

            if( $response->ok() )
            {
                $user->sms_code = $response->code;
                $user->save();

                return response($response->code, 200);

            }else{

                return response()->json([
                    'status' => false,
                    'errors' => [
                        'phone' => [
                            $response->object()->requestError->serviceException->text,
                        ]
                    ],
                ], 401);

            }


        }

        return response('В профиле не привязан номер телефона', 422);

    }

    /**
     * @param OtpRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse
     */
    protected function otp($request)
    {

        $response = $this->api($request->input('phone'), (string)$request->input('code'));

        if( $response->ok() )
        {

            return response()->json([
                'status' => true,
                'message' => __( 'ОТП успешно отправлен' ),
            ], 200);

        }else{

            return response()->json([
                'status' => false,
                'errors' => [
                    'phone' => [
                        $response->object()->requestError->serviceException->text,
                    ]
                ],
            ], 401);

        }

    }

}
