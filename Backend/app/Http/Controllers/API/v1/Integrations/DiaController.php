<?php

namespace Backend\Http\Controllers\API\v1\Integrations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiaController extends \Backend\Http\Controllers\Controller
{
    private function diaRequest(array $scopes, array $data = [])
    {
        $base_url = 'https://api2.diia.gov.ua/';
        $response = Http::get($base_url . 'api/v1/auth/acquirer/sZ3NXZuKUssa5bzaaD44eJcANzfmaXRczwC8mVH6XYRTZ3EMgysmSuxwDDtqcVtC');

        $token = $response->json('token');
        if(! $token) throw new \Exception('Authentication error');

        $response = Http::withToken($token)->post($base_url . 'api/v2/acquirers/branch', [
            'customFullName' => "Повна назва запитувача",
            'customFullAddress' => "Повна адреса відділення",
            'name' => "Назва відділення",
            'email' => "nikolayEgorov89@gmail.com",
            'region' => "Область",
            'district' => "Район",
            'location' => "Місто",
            'street' => "Вулиця",
            'house' => "Будинок",
            'deliveryTypes' => ["api"],
            'offerRequestType' => "dynamic",
            'scopes' => $scopes
        ]);
        $branch_id = $response->json('_id');

        $response = Http::withToken($token)->post($base_url . 'api/v1/acquirers/branch/' . $branch_id . '/offer', [
            'name' => 'string',
            'scopes' => $scopes
        ]);
        $offer_id = $response->json('_id');

        $time = time();
        $request_id = base64_encode(md5($time));

        $request = [
            "offerId" => $offer_id,
            "requestId" => $request_id
        ];
        if(count($data) > 0) $request['data'] = $data;

        $response = Http::withToken($token)->post($base_url . 'api/v2/acquirers/branch/' . $branch_id . '/offer-request/dynamic', $request);

        return $response->json('deeplink');
    }

    public function index()
    {
        $data = [];
//        $scopes = ['diiaId' => ['auth']];
//        $scopes = ["sharing" => ["foreign-passport"]];

        $file = 'https://test-front.vuso.ua/document/get/343?file=yTXrMXq7OqdzEWya9bs3pi3ui6KCOn5KoiuQUlAe.pdf';

        $scopes = ['diiaId' => ['hashedFilesSigning']];
        $data = [
            "hashedFilesSigning" => [
                "hashedFiles" => [
                    [
                        "fileName" => "yTXrMXq7OqdzEWya9bs3pi3ui6KCOn5KoiuQUlAe.pdf",
                        "fileHash" => base64_encode(file_get_contents($file))
                    ]
                ]
            ]
        ];


//        dd($this->diaRequest($scopes));
        return '<a style="font-size: 36px" href="'. $this->diaRequest($scopes, $data) .'">Dia Test</button>';
    }

    public function webhook(Request $request): \Illuminate\Http\JsonResponse
    {
        \Backend\Models\Log::debug($request->all(), __LINE__, __FILE__);

        return response()->json(["success" => true]);
    }
}