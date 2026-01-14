<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('Superadmin123!'),
                'employee_id' => 1,
                'avatar' => null,
                // 'user_role_types_id' => 1,
                'user_status_id' => 1,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'HR Admin',
                'email' => 'hr@gmail.com',
                'password' => bcrypt('Hradmin123!'),
                'employee_id' => 2,
                'avatar' => null,
                // 'user_role_types_id' => 2,
                'user_status_id' => 1,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Employee',
                'email' => 'user@gmail.com',
                'password' => bcrypt('User123!'),
                'employee_id' => 3,
                'avatar' => null,
                // 'user_role_types_id' => 3,
                'user_status_id' => 1,
                'email_verified_at' => now(),
            ],
        ]);
    }
}
