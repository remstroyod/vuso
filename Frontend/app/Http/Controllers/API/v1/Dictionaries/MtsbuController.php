<?php

namespace Frontend\Http\Controllers\API\v1\Dictionaries;

use Backend\Models\Dictionaries\Mtsbu\City;
use Backend\Http\Resources\API\v1\Dictionaries\Ewa\CityResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class MtsbuController extends Controller
{
    public function cities()
    {

        $cities = City::query()->get();

        return CityResource::collection($cities);
    }
}
