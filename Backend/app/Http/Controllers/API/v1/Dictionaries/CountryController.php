<?php

namespace Backend\Http\Controllers\API\v1\Dictionaries;

use Backend\Http\Resources\API\v1\Dictionaries\CountryResource;
use Backend\Models\Dictionaries\Country;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    /**
     * @return void
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

}
