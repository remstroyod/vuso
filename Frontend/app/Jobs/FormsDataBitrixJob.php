<?php

namespace Frontend\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Backend\Enums\FormsEnum;
use Backend\Models\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FormsDataBitrixJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private static $createContactUrl = 'https://bitrix24.vuso.ua/rest/1/tk633g2pcnpbfho2/crmium.contact.add';
    
    private static $createDealUrl = 'https://bitrix24.vuso.ua/rest/1/tk633g2pcnpbfho2/crm.deal.add';

    private $form;

    private $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($form, $request)
    {
        $this->form = $form;
        $this->request = $request;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $type = $this->form->type;

        $arr = [];

        if( $type == FormsEnum::subscribe )
        {

            $arr = [
                'fields' => [
                    'NAME' => 'Підписатися на email розсилку',
                    /********Not a Nessaccary *********/
                    'TITLE' => $this->request['title'] ?? null,
                    'TYPE_ID' => $this->request['type_id'] ?? null,
                    'SOURCE_ID' => $this->request['source_id'] ?? null,
                    'CATEGORY_ID' => $this->request['category_id'] ?? null,
                    /********Not a Nessaccary *********/
                    'SOURCE_DESCRIPTION' => (array_key_exists('crm', $this->request)) ? $this->request['crm']['source_description'] : '',
                    'EMAIL' => [
                        'VALUE' => $this->form->email,
                        'VALUE_TYPE' => (array_key_exists('crm', $this->request)) ? $this->request['crm']['value_type'] : '',
                    ],
                    'UF_CRM_1653598826108' => 1
                ]
            ];

        }

        if(
            $type == FormsEnum::request ||
            $type == FormsEnum::consultation ||
            $type == FormsEnum::faq ||
            $type == FormsEnum::support ||
            $type == FormsEnum::question ||
            $type == FormsEnum::messenger ||
            $type == FormsEnum::add_contract
        ) {

            $arr = [
                'fields' => [
                    'NAME' => Auth::check() ? Auth::user()->detail->fullname : $this->form->name,
                    'COMMENTS' => $this->request['message'] ?? null,
                    'SOURCE_ID' => $this->request['source_id'] ?? null,
                    'CATEGORY_ID' => $this->request['category_id'] ?? null,
                    'TYPE_ID' => $this->request['type_id'] ?? null,
                    'TITLE' => $this->request['title'] ?? null,
                    'PHONE' => [
                        'VALUE' => $this->form->phone ?? $this->request['phone'] ?? null,
                        'VALUE_TYPE' => 'MOBILE',
                    ],
                    'EMAIL' => [
                        'VALUE' => $this->form->email ?? $this->request['email'] ?? null,
                        'VALUE_TYPE' => (array_key_exists('crm', $this->request)) ? $this->request['crm']['value_type'] : '',
                    ],
                    'INN' => $this->request['inn'],
                    'UF_CRM_1641984798' => $this->request['UF_CRM_1641984798']
                ]
            ];

        }

        info($arr);

        if(empty($arr)){
        
            $this->delete();
        
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
                }

                if($createdDealResponse->failed()){
                    Log::debug($createdDealResponse->getReasonPhrase(), __LINE__, __FILE__);
                }
            }

        } catch (\Throwable $e) {

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
                "TITLE"              =>  $data['fields']['TITLE'] ?? null, 
                "COMMENTS"           =>  $data['fields']['COMMENTS'] ?? $data['fields']['INN'] ?? null,
                "STAGE_ID"           =>  "NEW",
                "SOURCE_ID"          =>  $data['fields']['SOURCE_ID'] ?? null,
                "CONTACT_ID "        =>  $data['fields']['bitrix_id'] ?? null,
                "CATEGORY_ID"        =>  $data['fields']['CATEGORY_ID'] ?? null,
                "TYPE_ID"            =>  $data['fields']['TYPE_ID'] ?? null,
                "ASSIGNED_BY_ID"     =>  665, 
                "SOURCE_DESCRIPTION" => "Каталог В2В продуктов",
                'UF_CRM_1641984798'  => $data['fields']['UF_CRM_1641984798']

            ]
        ];
        Log::debug($arr, __LINE__, __FILE__);
        return $arr;

    }
}
