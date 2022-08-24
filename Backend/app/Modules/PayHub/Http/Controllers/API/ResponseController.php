<?php

namespace Backend\Modules\PayHub\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Backend\Modules\PayHub\Services\PayService;

class ResponseController extends Controller
{
    public function response(Request $request, string $service, string $response)
    {
        return PayService::parseResponse($request, $service, $response);
    }
}