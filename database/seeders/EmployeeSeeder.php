<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        DB::table('employees')->insert([
            [
                'user_id'       => 1,
                'employee_code' => 'E000001',
                'name'          => 'Super Admin',
                'email'         => 'superadmin@gmail.com',
                'company'       => 'Sunway Group',
                'department_id' => 1,
                'position_id'   => 1,
                'phone_number'  => '0192675696',
                'join_date'     => '1970-01-01',
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 2,
                'employee_code' => 'E000002',
                'name'          => 'HR Admin',
                'email'         => 'hr@gmail.com',
                'company'       => 'Sunway Group',
                'department_id' => 1,
                'position_id'   => 2,
                'phone_number'  => '0192675697',
                'join_date'     => '1970-01-01',
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => 3,
                'employee_code' => 'E000003',
                'name'          => 'Employee',
                'email'         => 'employee@gmail.com',
                'company'       => 'Sunway Group',
                'department_id' => 2,
                'position_id'   => 3,
                'phone_number'  => '0192675697',
                'join_date'     => '1970-01-01',
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
