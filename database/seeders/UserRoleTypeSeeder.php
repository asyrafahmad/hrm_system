<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UserRoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role_types')->insert([
            ['name' => 'Admin'],
            ['name' => 'Super Admin'],
            ['name' => 'Normal User'],
            ['name' => 'Client'],
            ['name' => 'Employee']
        ]);
    }
}
