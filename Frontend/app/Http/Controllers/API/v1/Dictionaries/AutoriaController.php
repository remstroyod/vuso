<?php

namespace Frontend\Http\Controllers\API\v1\Dictionaries;

use Backend\Http\Resources\API\v1\Dictionaries\Autoria\MarkResource;
use Backend\Http\Resources\API\v1\Dictionaries\DictionaryResource;
use Backend\Http\Resources\API\v1\Dictionaries\DictionaryLocalizationResource;
use Backend\Http\Resources\API\v1\Dictionaries\Autoria\ModelsResource;
use Backend\Http\Resources\API\v1\Dictionaries\Autoria\TransmissionsResource;
use Backend\Http\Resources\API\v1\Dictionaries\Autoria\TsTypeResource;
use Backend\Models\Dictionaries\Autoria\Mark;
use Backend\Models\Dictionaries\Autoria\Models;
use Backend\Models\Dictionaries\Autoria\Transmissions;
use Backend\Models\Dictionaries\Autoria\TsType;
use Backend\Modules\EDocuments\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutoriaController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
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

        return DictionaryResource::collection($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function models(Request $request)
    {

        $mark = $request->input('mark');
        $result = Models::when($mark, function ($query, $mark) {
            $query->where('mark_id', $mark);
        })->get();

        if(!$result) {

            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return DictionaryResource::collection($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function transmissions(Request $request)
    {

        $result = Transmissions::all();

        if(!$result) {

            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return DictionaryResource::collection($result);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function tstype(Request $request)
    {

        $result = TsType::all();

        if(!$result) {

            return response()->json([
                'data' => [],
                'message' => 'No Results Found'
            ], 403);
        }

        return DictionaryLocalizationResource::collection($result);
    }

}
