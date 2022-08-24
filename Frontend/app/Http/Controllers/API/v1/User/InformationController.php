<?php

namespace Frontend\Http\Controllers\API\v1\User;

use Frontend\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Frontend\Models\Profile\User;

class InformationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVehicle(Request $request)
    {
        
        $vehicles =  $request->user()->insuranceAuto;
        
        return response()->json([
            'status' => true,
            'data' => $vehicles,
        ], 200);
    }
}
