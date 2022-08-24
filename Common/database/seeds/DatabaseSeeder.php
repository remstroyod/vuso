<?php

use Database\Seeders\EDocumentsSeeder;
use Database\Seeders\InsuranceStatusListSeeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\SettingsSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(EDocumentsSeeder::class);
    }
}
