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
                'id'            => 1,
                'employee_code' => 'E000001',
                'name'          => 'Super Admin',
                'email'         => 'superadmin@gmail.com',
                'birth_date'    => '1990-01-01',
                'gender'        => 'Male',
                'company'       => 'Human Resource Department',
                'department'    => 'Human Resource Department',
                'position'      => 'Human Resource Department',
                'phone_number'  => '0192675696',
                'join_date'     => '1970-01-01',
                'status'        => 'active',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => 2,
                'employee_code' => 'E000002',
                'name'          => 'HR Admin',
                'email'         => 'hr@gmail.com',
                'birth_date'    => '1990-02-02',
                'gender'        => 'Male',
                'company'       => 'Human Resource Department',
                'department'    => 'Human Resource Department',
                'position'      => 'Human Resource Department',
                'phone_number'  => '0192675697',
                'join_date'     => '1970-01-01',
                'status'        => 'active',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => 3,
                'employee_code' => 'E000003',
                'name'          => 'User',
                'email'         => 'user@gmail.com',
                'birth_date'    => '1990-03-03',
                'gender'        => 'Male',
                'company'       => 'Information Technology',
                'department'    => 'Information Technology',
                'position'      => 'Information Technology',
                'phone_number'  => '0192675697',
                'join_date'     => '1970-01-01',
                'status'        => 'active',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'            => 4,
                'employee_code' => 'E000004',
                'name'          => 'Asyraf',
                'email'         => 'asyraf@gmail.com',
                'birth_date'    => '1997-04-01',
                'gender'        => 'Male',
                'company'       => 'Information Technology',
                'department'    => 'Information Technology',
                'position'      => 'Information Technology',
                'phone_number'  => '0192675697',
                'join_date'     => '1970-01-01',
                'status'        => 'active',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
