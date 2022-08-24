<?php
namespace Frontend\Listeners;

use Backend\Models\Log;
use Backend\Enums\FormsEnum;
use Exception;
use Frontend\Events\FormsDataEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class FormsDataBitrix
{

    private static $createContactUrl = 'https://bitrix24.vuso.ua/rest/1/tk633g2pcnpbfho2/crmium.contact.add';
    
    private static $createDealUrl = 'https://bitrix24.vuso.ua/rest/1/tk633g2pcnpbfho2/crm.deal.add';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        info('constrict');
    }

    /**
     * Handle the event.
     *
     * @param  \Frontend\Events\FormsDataEvent  $event
     * @return void
     */
    public function handle(FormsDataEvent $event)
    {

        $form = $event->formsData;

        dispatch(function () use ($form) {
            self::isForm($form);
        })->onConnection('sync');

    }

    /**
     * @param $data
     * @return void
     */
    private static function isForm($data)
    {

        $form = $data->type;
        $request = Request::all();
        $arr = [];
        info($form);
        if( $form == FormsEnum::subscribe )
        {

            $arr = [
                'fields' => [
                    'NAME' => 'Підписатися на email розсилку',
                    'SOURCE_DESCRIPTION' => (array_key_exists('crm', $request)) ? $request['crm']['source_description'] : '',
                    'EMAIL' => [
                        'VALUE' => $data->email,
                        'VALUE_TYPE' => (array_key_exists('crm', $request)) ? $request['crm']['value_type'] : '',
                    ],
                    'UF_CRM_1653598826108' => 1
                ]
            ];

        }

        if(
            $form == FormsEnum::request ||
            $form == FormsEnum::consultation ||
            $form == FormsEnum::faq ||
            $form == FormsEnum::support ||
            $form == FormsEnum::question ||
            $form == FormsEnum::messenger
        ) {

            $arr = [
                'fields' => [
                    'NAME' => Auth::check() ? Auth::user()->detail->fullname : $data->name,
                    'COMMENTS' => $request['message'] ?? null,
                    'SOURCE_ID' => $request['source_id'] ?? null,
                    'CATEGORY_ID' => $request['category_id'] ?? null,
                    'TYPE_ID' => $request['type_id'] ?? null,
                    'TITLE' => $request['title'] ?? null,
                    'PHONE' => [
                        'VALUE' => $data->phone ?? $request['phone'] ?? null,
                        'VALUE_TYPE' => 'MOBILE',
                    ],
                    'EMAIL' => [
                        'VALUE' => $data->email ?? $request['email'] ?? null,
                        'VALUE_TYPE' => (array_key_exists('crm', $request)) ? $request['crm']['value_type'] : '',
                    ],
                ]
            ];

        }

        info($arr);

        if(empty($arr)){
        
            throw new Exception('Array is empty!');
        
        }
        
        self::sendBitrix($arr);

    }

    /**
     * @param $request
     * @return void
     */
    private static function sendBitrix($request)
    {
        try {

            $createdContactResponse =   Http::withHeaders([
                                            'Content-Type' => 'application/json',
                                        ])
                                        ->retry(config('constants.api.retry'), config('constants.api.milliseconds'))
                                        ->post(self::$createContactUrl, $request);

            if($createdContactResponse->ok())
            {

                $request['fields']['bitrix_id'] = $createdContactResponse['result']['new_id'][0] ?? $createdContactResponse['result']['id'][0];

                $dealForm = self::dealForm($request);

                $createdDealResponse =  Http::withHeaders([
                                            'Content-Type' => 'application/json',
                                        ])
                                        ->retry(config('constants.api.retry'), config('constants.api.milliseconds'))
                                        ->post(self::$createDealUrl, $dealForm);

                if($createdDealResponse->ok()){
                    Log::debug($createdDealResponse->json(), __LINE__, __FILE__);
                    info($createdDealResponse->json());
                }

                if($createdDealResponse->failed()){
                    Log::debug($createdDealResponse->getReasonPhrase(), __LINE__, __FILE__);
                    info($createdDealResponse->getReasonPhrase());
                }
            }

        } catch (\Throwable $e) {

            info($e->getMessage());
            report($e);

        }

    }

        /**
     * @param $data
     * @return array
     */
    private static function dealForm(array $data): array
    {
        $arr = [];

        $arr = [
            "fields" => [
                "TITLE"              =>  $data['fields']['TITLE'], 
                "COMMENTS"           =>  $data['fields']['COMMENTS'],
                "STAGE_ID"           =>  "NEW",
                "SOURCE_ID"          =>  $data['fields']['SOURCE_ID'],
                "CONTACT_ID "        =>  $data['fields']['bitrix_id'],
                "CATEGORY_ID"        =>  $data['fields']['CATEGORY_ID'],
                "TYPE_ID"            =>  $data['fields']['TYPE_ID'],
                "ASSIGNED_BY_ID"     =>  665, 
                "SOURCE_DESCRIPTION" => "Каталог В2В продуктов",
            ]
        ];
        Log::debug($arr, __LINE__, __FILE__);
        info($arr);
        return $arr;

    }

}
