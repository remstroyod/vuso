<?php

namespace Backend\Modules\Bots\Http\Controllers;

use Egorovwebservices\Response\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BotsController extends BaseController
{
    public function webhook(Request $request, string $bot_type)
    {
        $request_data = $request->all();

        \Backend\Modules\Bots\Models\Log::debug($request_data, $bot_type,__LINE__, __FILE__);
        $response = Http::post('http://localhost:8001/api/hook/' . $bot_type, $request_data);
        \Backend\Modules\Bots\Models\Log::debug($response->json() ?? [], $bot_type,__LINE__, __FILE__);

        $resp = (new Response())->setStatus($response->status() === 200);
        return response()->json($resp, $response->status());
    }
}