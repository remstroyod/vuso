<?php

namespace Frontend\Http\Controllers\API\v1\Dictionaries;

use Backend\Http\Resources\API\v1\Dictionaries\CountryResource;
use Frontend\Http\Resources\API\v1\Dictionaries\Ewa\CityResource;
use Backend\Models\Dictionaries\Country;
use Backend\Models\Dictionaries\Ewa\City;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function countries(Request $request)
    {

        $result = Country::where('is_valid', 1)->where('is_disabled', 0)->get();

        if(!$result) {

            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return CountryResource::collection($result);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function citiesByCountry(Request $request)
    {

        $localeName = empty($request->locale) || $request->locale === 'ua' ? 'name_full' : 'name_full_rus';
        $result = City::where('country', $request->code)->where($localeName, 'like' , '%'.$request->term.'%');
        $page = $request->input('page') ?: 1;
        $take = $request->input('count') ?: 30;
        $count = $result->count();
        if ($page) {
            $skip = $take * ($page - 1);
            $result = $result->take($take)->skip($skip);
        } else {
            $result = $result->take($take)->skip(0);
        }

        if(!$result->get()) {
            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return response()->json([
            "results" => CityResource::collection($result->get()),
             "count_filtered" => $count,
             "pagination" => [
                   "more"=> true
             ]
            ], 200);

    }

}
