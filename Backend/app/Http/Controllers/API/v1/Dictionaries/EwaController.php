<?php

namespace Backend\Http\Controllers\API\v1\Dictionaries;

use Backend\Http\Resources\API\v1\Dictionaries\Ewa\CityResource;
use Backend\Http\Resources\API\v1\Dictionaries\Ewa\MarkResource;
use Backend\Http\Resources\API\v1\Dictionaries\Ewa\ModelsResource;
use Backend\Models\Dictionaries\Ewa\City;
use Backend\Models\Dictionaries\Ewa\Mark;
use Backend\Models\Dictionaries\Ewa\Models;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EwaController extends Controller
{

    /**
     * @return void
     */
    public function city(Request $request)
    {

        $result = City::all();

        if(!$result) {

            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return CityResource::collection($result);

    }

    /**
     * @return void
     */
    public function mark(Request $request)
    {

        $result = Mark::all();

        if(!$result) {

            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return MarkResource::collection($result);

    }

    /**
     * @return void
     */
    public function models(Request $request)
    {
        $mark = $request->input('mark');

        $Mark = new Mark();
        $Model = new Models();

        $Models = Models::query()
            ->join($Mark->getTable(), $Model->getTable() . '.'
                . $Model->getEwaMakerIdFieldName(), '=', $Mark->getTable() . '.' . $Mark->getEwaIdFieldName())
            ->where($Mark->getTable() . '.id', $mark)->get([$Model->getTable() . '.*']);

        if($Models->count() === 0) {
            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return ModelsResource::collection($Models);

    }


}
