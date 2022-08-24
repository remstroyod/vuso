<?php
namespace Database\Seeders;

use Backend\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Settings::insert([
            [
                'name' => 'site_description',
                'value' => 'Описание Vuso',
            ],
            [
                'name' => 'site_email',
                'value' => 'example@gmail.com',
            ],
            [
                'name' => 'site_favicon',
                'value' => '',
            ],
            [
                'name' => 'site_logo',
                'value' => '',
            ],
            [
                'name' => 'site_logo_mobile',
                'value' => '',
            ],
            [
                'name' => 'site_name',
                'value' => 'Vuso',
            ],
            [
                'name' => 'site_url',
                'value' => 'https://vuso.ua',
            ],
            [
                'name' => 'site_url_admin',
                'value' => 'https://admin.vuso.ua',
            ],
            [
                'name' => 'url_app_api_backend',
                'value' => '/api/v1',
            ],
            [
                'name' => 'url_app_api_frontend',
                'value' => '/api/v1',
            ],
        ]);

    }
}

