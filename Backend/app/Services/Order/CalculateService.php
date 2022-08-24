<?php

namespace Backend\Services\Order;


class CalculateService
{

    public function __construct()
    {
        //
    }

    public function divideByUserCount($total, array $clients, string $promocode): array
    {
        $clientsCount = count($clients);

        $forEachClient = $this->changeFormat2($total / $clientsCount);

        $data = [];
        
        $countWithOutLastClient = $clientsCount > 1 ? $clientsCount - 1 : 1;

        $eachClientSumExceptForTheLastClient  = $this->changeFormat2($forEachClient * $countWithOutLastClient);

        $forTheLastClient = $this->changeFormat2($total - $eachClientSumExceptForTheLastClient);

        $data = [
            'code' => $promocode,
            "value" => $forEachClient
        ];

        data_set($clients, '*.promocode', $data);

        $data['value'] =  $forTheLastClient;

        $lastClientIndex = $clientsCount - 1;

        data_set($clients, "{$lastClientIndex}.promocode", $data);

        return $clients;

    }

    private function changeFormat($number)
    {
        return floor($number*100)/100;
    }

    private function changeFormat2($number){
        $explode = explode('.', $number);
        return $explode[0].".".substr($explode[1],0,2);
    }


}
