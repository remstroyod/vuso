<?php

namespace Backend\Http\Controllers\API\v1\Dictionaries;

use Egorovwebservices\Dictionaries\Enums\AutoCategoriesEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class CarController extends Controller
{
    public function autoCategories(): JsonResponse
    {
        $categories = [];
        foreach(AutoCategoriesEnum::$categories as $id => $title) {
            $categories[] = ['value' => $id, 'name' => $title];
        }

        return response()->json($categories, 200);
    }
}