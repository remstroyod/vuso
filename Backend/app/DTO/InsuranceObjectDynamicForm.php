<?php 

namespace Backend\DTO;


class InsuranceObjectDynamicForm implements \Serializable, \JsonSerializable
{
    protected  $request;

    protected $data;

    public function __construct()
    {

    }

    // public function obj_insurance_homes($request){
    //     return [];
    // }

    // public function obj_insurance_autos($request){
    //     return [];
    // }

    public function obj_insurance_person($request){
        $clients = [];
        if($request->clients && count($request->clients)){
            foreach($request->clients as $client){
                $clients[] = [
                    'middle_name'            => $client['surname'],
                    'lk_Id'                  => $client['lk_Id'] ?? 4564,                 
                    'address_string'         => $client['address'],
	                'INN'                    => $client['inn'] ?? '555555555555555',
	                'last_name'              => $client['name'],
	                'first_name'             => $client['name'],
	                'birthday'               => $client['name'] ?? 'BBBBBBBBBB',
	                'mail'                   => $client['email'] ?? 'test@gmail.com',
	                'phone_number'           => $client['phone'],
	                'code'                   => $client['code'] ?? '0455',
	                'ukr_passport'           => $client['ukr_passport'] ?? '4564565455',
	                'international_passport' => $client['international_passport'] ?? '4564565455',
	                'user_id'                => $client['user_id'] ?? 251,
                ];
            }
        }
        
        $this->data = $clients;
    }

    public function serialize(): string
    {
    }

    public function unserialize($data): CarSearchTransform
    {
    }

    public function jsonSerialize()
    {
        return $this->data;
    }

}