<?php

namespace Backend\Modules\EDocuments\Http\Controllers\API;

use Frontend\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Backend\Modules\EDocuments\Http\Resources\MtsBuResource;
use Backend\DTO\CarSearchTransform;

class SearchController extends Controller
{
    protected $urlApi = 'https://ipa.vuso.ua/api';

    public function searchCar(Request $request)
    {

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($this->urlApi . '/data/search/car/by-number?number=' . $request->number);

        if( $response->ok() )
        {

            return response($response->json(), 200);

        }

        return response([
            'message' => $response->clientError(),
            'status' => false,
        ], 422);
    }
}
