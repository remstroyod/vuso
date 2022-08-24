<?php

namespace Frontend\Services;

use Backend\Enums\OrderStatusEnum;
use Backend\Models\Catalog\Product;
use Backend\Models\Ecommerce\Order;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Frontend\Models\InsuranceStatusList;
use Frontend\Models\ObjInsuranceBuildings;
use Frontend\Models\ObjInsuranceCars;
use Frontend\Models\ObjInsurancePerson;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class ConnectionOneCService
{

    protected $url;
    protected $http;
    protected $headers;
    protected $phoneNumber;

    public function __construct()
    {
        $this->url = env('1C_URL', 'https://ewa-in.vuso.ua/OperKontur/hs/service-entry/GetDocByLkId');
        $this->http = new Client();
        $this->headers = [
            'Authorization' => 'Basic ' . env('1C_TOKEN', 'RXh0ZXJuYWxTeXN0ZW1JbnRlZ3JpdHlPdGhlcjpPdGhlckludGVncml0eVN5c3RlbUV4dGVybmFs'),
            'content-type' => 'application/json',
        ];
    }

    /**
     * @param $phoneNumber
     * @return object|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInsuranceDocs($phoneNumber)
    {

        $full_path = $this->url;
        $this->phoneNumber = $phoneNumber;
        $request = $this->http->post($full_path, [
            'headers' => $this->headers,
            'json' => [
                'PhoneNumber' => $this->phoneNumber
            ]
            ]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            return json_decode($response, true);
        }

        return null;
    }

    public function createInsuranceDocs($user)
    {

        $phone = preg_replace('/\+(?:998|996|995|994|993|992|977|976|975|974|973|972|971|970|968|967|966|965|964|963|962|961|960|886|880|856|855|853|852|850|692|691|690|689|688|687|686|685|683|682|681|680|679|678|677|676|675|674|673|672|670|599|598|597|595|593|592|591|590|509|508|507|506|505|504|503|502|501|500|423|421|420|389|387|386|385|383|382|381|380|379|378|377|376|375|374|373|372|371|370|359|358|357|356|355|354|353|352|351|350|299|298|297|291|290|269|268|267|266|265|264|263|262|261|260|258|257|256|255|254|253|252|251|250|249|248|246|245|244|243|242|241|240|239|238|237|236|235|234|233|232|231|230|229|228|227|226|225|224|223|222|221|220|218|216|213|212|211|98|95|94|93|92|91|90|86|84|82|81|66|65|64|63|62|61|60|58|57|56|55|54|53|52|51|49|48|47|46|45|44\D?1624|44\D?1534|44\D?1481|44|43|41|40|39|36|34|33|32|31|30|27|20|7|1\D?939|1\D?876|1\D?869|1\D?868|1\D?849|1\D?829|1\D?809|1\D?787|1\D?784|1\D?767|1\D?758|1\D?721|1\D?684|1\D?671|1\D?670|1\D?664|1\D?649|1\D?473|1\D?441|1\D?345|1\D?340|1\D?284|1\D?268|1\D?264|1\D?246|1\D?242|1)\D?/', ''
            , '+' . $user->phone
        );
        $docs = $this->getInsuranceDocs('0' . $phone);
//        $docs = $this->getInsuranceDocs('380503751705'); // home
//        $docs = $this->getInsuranceDocs('380509691113'); // person
        if (isset($docs['data'][0]['doc'])) {
            foreach ($docs['data'][0]['doc'] as $doc) {
                try {
                    $product = Product::firstOrCreate(
                        ['doc_id_1c' =>  $doc['DocProductID']],
                        [
                            'doc_id_1c' =>  $doc['DocProductID'],
                            'doc_name_1c' =>  $doc['DocProduct'],
                            'name' => ['ru' => $doc['DocProduct']],
                            'slug' => Str::slug($doc['DocProduct']),
                            'type' => 1
                        ]
                    );
                    $objModel = null;
                    $objId = null;
                    $objType = null;
                    if ($doc['AutoVIN']) {
                        $objModel = '\ObjInsuranceCars';
                        $objType = 'car';
                        $obj = ObjInsuranceCars::updateOrCreate(
                            [
                                'vin'  => $doc['AutoVIN'],
                            ],
                            [
                                'reg_num' => $doc['AutoRegNum'],
                                'engine_volume'  => $doc['AutoEngineVolume'],
                                'type'  => $doc['AutoType'],
                                'number_passengers'  => $doc['AutoТumberPassengers'],
                                'mark'  => $doc['AutoMark'],
                                'model'  => $doc['AutoModel'],
                                'cargo'  => $doc['AutoСargo'],
                                'vin'  => $doc['AutoVIN'],
                                'year'  => $doc['AutoYear'],
                                'run'  => $doc['AutoRun'],
                                'cost'  => $doc['Autocost'],
                                'user_id'  => $user->user_id,
                            ]);
                        $objId = $obj->id;
                    } else if (count($doc['insured'])) {
                        $objModel = '\ObjInsurancePerson';
                        $objType = 'person';
                        $objId = [];
                        foreach ($doc['insured'] as $insured) {
                            $obj = ObjInsurancePerson::updateOrCreate(
                                [
                                    'international_passport'  => preg_replace('/\s+/', '', $insured['InternationalPassport']),
                                    'user_id'  => $user->user_id,
                                ],
                                [
                                    'middle_name' => $insured['MiddleName'],
                                    'lk_Id'  => $insured['LkId'],
                                    'address_string'  => $insured['AddressString'],
                                    'INN'  => $insured['INN'],
                                    'first_name'  => $insured['FirstName'],
                                    'last_name'  => $insured['LastName'],
                                    'birthday'  => $insured['DateBegin'],
                                    'mail'  => $insured['Mail'],
                                    'phone_number'  => $insured['PhoneNumber'],
                                    'code'  => $insured['Code'],
                                    'ukr_passport'  => preg_replace('/\s+/', '', $insured['UkrPassport']),
                                    'international_passport'  => preg_replace('/\s+/', '', $insured['InternationalPassport']),
                                    'user_id'  => $user->user_id,
                                ]);
                            array_push($objId, $obj->id);
                        }
                    } else if (!$doc['AutoVIN'] && count($doc['insured']) && $doc['DocProduct'] !== 'МАЙНО') {
                        $objModel = '\ObjInsurancePerson';
                        $objType = 'person';
                        $insured = $docs['data'][0]['insurant'][0];
                        $obj = ObjInsurancePerson::updateOrCreate(
                            [
                                'international_passport'  => preg_replace('/\s+/', '', $insured['InternationalPassport']),
                                'code'  => $insured['Code'],
                                'user_id'  => $user->user_id,
                            ],
                            [
                                'middle_name' => $insured['MiddleName'],
                                'lk_Id'  => $insured['LkId'],
                                'address_string'  => $insured['AddressString'],
                                'INN'  => $insured['INN'],
                                'first_name'  => $insured['FirstName'],
                                'last_name'  => $insured['LastName'],
                                'birthday'  => $insured['DateBegin'],
                                'mail'  => $insured['Mail'],
                                'phone_number'  => $insured['PhoneNumber'],
                                'code'  => $insured['Code'],
                                'ukr_passport'  => preg_replace('/\s+/', '', $insured['UkrPassport']),
                                'international_passport'  => preg_replace('/\s+/', '', $insured['InternationalPassport']),
                                'user_id'  => $user->user_id,
                            ]);
                        $objId = $obj->id;
                    } else if ($doc['DocProduct'] === 'МАЙНО') {
                        $objModel = '\ObjInsuranceBuildings';
                        $objType = 'building';
                        $obj = ObjInsuranceBuildings::updateOrCreate(
                            [
                                'address'  => $doc['Adress'],
                                'user_id'  => $user->user_id,
                            ],
                            [
                                'address' => $doc['Adress'],
                                'user_id'  => $user->user_id,
                            ]);
                        $objId = $obj->id;
                    }
                    if ($objModel) {
                        $status = InsuranceStatusList::firstOrCreate(
                            ['1c_status' => $doc['DocState']],
                            [
                                '1c_status' => $doc['DocState'],
                                'name' => ['ru' => $doc['DocState']],
                            ]
                        );
                        $document = EdocumentUser::updateOrCreate(
                            [
                                'doc_blank_1c' => $doc['DocBlank']
                            ],
                            [
                                'doc_blank_1c' => $doc['DocBlank'],
                                'doc_end_date' => $doc['DocEndDate'],
                                'user_id'  => $user->user_id,
                                'product_id'  => $product->id,
                                'total'  => $doc['DocAmount'],
                                'subtotal'  => $doc['DocPayment'],
                                'obj_model'  => $objModel,
                                'obj_type'  => $objType,
                                'status_id'  => $status->id,
                                'documents_id'  => 1,
                            ]);
                        if ($objType === 'car') {
                            $document->obj_insurance_autos()->sync($objId);
                        } else if ($objType === 'person') {
                            $document->obj_insurance_person()->sync($objId);
                        } else if ($objType === 'building') {
                            $document->obj_insurance_homes()->sync($objId);
                        }


                        Order::updateOrCreate(
                            [
                                'doc_blank_1c' => $doc['DocBlank']
                            ],
                            [
                                'doc_blank_1c' => $doc['DocBlank'],
                                'user_id'  => $user->user_id,
                                'order_id'  => $doc['DocBlank'],
                                'subtotal'  => $doc['DocAmount'],
                                'total'  => $doc['DocPayment'],
                                'status'  => OrderStatusEnum::paid,
                                'document_id'  => $document->id,
                            ]);
                    }


                } catch (\Throwable $e) {
                    dd($e->getMessage());
                    return $e->getMessage();
                }
            }
        }
    }


}
