<?php
namespace Backend\Modules\EDocuments\Http\Controllers\API;

use Backend\Models\Catalog\Product;
use Backend\Models\Profile\User;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Backend\Services\Order\CalculateService;
use Backend\Enums\CurrencyEnum;
use Egorovwebservices\Response\Response;

class CalculatorController extends Controller
{

    protected $urlApi = 'https://ipa.vuso.ua/api/v1';

    /**
     * @param Request $request
     */
    public function calculate(Request $request, Product $product)
    {
        if(!empty($request->currency)){
            $request->merge([
                'currency' => CurrencyEnum::name($request->currency),
            ]);
        }

        $data = $request->toArray();

        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $product->token,
            'Accept' => 'application/json',
        ])->post($this->urlApi . '/calculate-insurance', $data );

        if( $response->ok() )
        {

            return response($response->json(), 200);

        }

        return response([
            'message' => $response->clientError(),
            'status' => false,
        ], 422);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @param Request $request
     */
    public function save(Request $request, Product $product, CalculateService $calculateService)
    {
        
        if(!empty($request->currency)){
            $request->merge([
                'currency' => CurrencyEnum::name($request->currency),
            ]);
        }
        
        if(!empty($request->promocode))
        {
            $divideTotalByClientsCount = $calculateService->divideByUserCount($request->total, $request->clients, $request->promocode);
            
            $request->merge([
                'clients' => $divideTotalByClientsCount,
            ]);
        }
        
        $data = $request->toArray();

        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $product->token,
            'Accept' => 'application/json',
        ])->post($this->urlApi . '/save-insurance', $data );

        if( $response->ok() )
        {
            $responseService = new Response($response->json());

            if($responseService->hasErrors())
            {
                return response([
                    'message' => $responseService->getErrors(),
                    'status' => false,
                ], 422);
            }

            $result = $responseService->jsonSerialize();
            
            $updateDocument = new DocumentController();
            
            $updateDocument->storeDogovorInformation($request, $result);

            $user = User::findOrFail($request->user);

            $user->update(['otp' => Arr::get($result, 'data.response.contract.otp')]);

            Arr::forget($result, 'data.response.contract.otp');

            return response($result, 200);

        }

        return response([
            'message' => $response->clientError(),
            'status' => false,
        ], 422);

    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function buy(Request $request, Product $product)
    {

        $EdocumentUser = EdocumentUser::where('user_id', $request->input('user'))
                                    ->where('dogovor_id', $request->input('policy_no'))
                                    ->firstOrFail();

        $data = [
            'policy_no' => $request->input('policy_no'),
            'otp' => $request->input('otp'),
            'writing_method' => $request->input('writing_method'),
            'payhub_hash' => $EdocumentUser->transaction_hash
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $product->token,
            'Accept' => 'application/json',
        ])->post($this->urlApi . '/buy-insurance', $data );

        if( $response->ok() )
        {
            $result = $response->json();
            $update = $EdocumentUser->update([
                                        'dogovor_id' => Arr::get($result, 'data.response.contract.policy_no'),
                                    ]);

            return response($result, 200);

        }

        return response([
            'message' => $response->clientError(),
            'status' => false,
        ], 422);

    }

}
