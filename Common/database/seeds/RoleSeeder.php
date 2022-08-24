<?php
namespace Database\Seeders;

use Backend\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Super Admin
         */
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->type = 1;
        $admin->is_admin = 1;
        $admin->save();

        /**
         * Manager
         */
        $manager = new Role();
        $manager->name = 'Manager';
        $manager->slug = 'manager';
        $manager->type = 1;
        $manager->save();

        /**
         * Guest
         */
        $guest = new Role();
        $guest->name = 'Guest';
        $guest->slug = 'guest';
        $guest->type = 1;
        $guest->save();
    }
}
