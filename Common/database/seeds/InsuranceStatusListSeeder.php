<?php

namespace Database\Seeders;

use Frontend\Models\InsuranceStatusList;
use Illuminate\Database\Seeder;

class InsuranceStatusListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InsuranceStatusList::insert([
            [
                '1c_status' => 'Подписанный',
                'name' => '{"ru": "Не оплачен", "ua": "Не оплачен"}',
                'color' => '#CC261A',
                'parameter' => null
            ],
            [
                '1c_status' => 'Действующий',
                'name' => '{"ru": "Действует до ", "ua": "Действует до"}',
                'color' => '#02A16A',
                'parameter' => 'doc_end_date'
            ],
            [
                '1c_status' => 'Приостановленный',
                'name' => '{"ru": "Приостановлен до", "ua": "Приостановлен до"}',
                'color' => '#525B7C',
                'parameter' => 'doc_end_date'
            ],
            [
                '1c_status' => 'Завершенный',
                'name' => '{"ru": "Закончил действие", "ua": "Закончил действие"}',
                'color' => '#151826',
                'parameter' => 'doc_end_date'
            ],
            [
                '1c_status' => 'Расторгнутый',
                'name' => '{"ru": "Рассторжен", "ua": "Рассторжен"}',
                'color' => '#151826',
                'parameter' => 'doc_end_date'
            ],
            [
                '1c_status' => 'Не подписан',
                'name' => '{"ru": "Не подписан", "ua": "Не подписан"}',
                'color' => '#044F96',
                'parameter' => null
            ],
            [
                '1c_status' => 'Нужна дополнительная информация',
                'name' => '{"ru": "Нужна дополнительная информация", "ua": "Нужна дополнительная информация"}',
                'color' => '#5CADDF',
                'parameter' => null
            ],
            [
                '1c_status' => 'Отменен',
                'name' => '{"ru": "Отменен", "ua": "Отменен"}',
                'color' => '#151826',
                'parameter' => null
            ],
        ]);
    }
}
