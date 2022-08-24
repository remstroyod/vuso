<?php

namespace Database\Seeders;

use Backend\Models\Profile\User;
use Backend\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::where('slug', 'admin')->first();

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('1111');

        $user->save();

        $user->roles()->attach($super_admin);
    }
}
