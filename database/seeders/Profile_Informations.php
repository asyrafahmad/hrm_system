<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Profile_Informations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'rec_id' => 'Staff_ID_00000',
                'email' => 'admin@gmail.com',
                'birth_date' => '01-01-1970',
                'gender' => 'Male',
                'address' => 'HQ',
                'state' => 'Selangor',
                'country' => 'Malaysia',
                'pin_code'  => '70800',
                'phone_number' => '0192675696',
                'department' => 'Human Resource Department',
                'designation' => 'Human Resource',
                'reports_to' => 'Master Admin',
            ],
            [
                'name' => 'Muhammad Nur Asyraf',
                'rec_id' => 'Staff_ID_00001',
                'email' => 'asyraf@gmail.com',
                'birth_date' => '01-04-1997',
                'gender' => 'Male',
                'address' => 'No 1, Jalan D\'Belsa 2, Taman Bandar Senawang',
                'state' => 'Seremban',
                'country' => 'Malaysia',
                'pin_code'  => '70450',
                'phone_number' => '0192649693',
                'department' => 'Information Technology',
                'designation' => 'Web Developer',
                'reports_to' => 'Bexter',
            ],
            [
                'name' => 'Bexter Lim',
                'rec_id' => 'Staff_ID_00002',
                'email' => 'bexter@gmail.com',
                'birth_date' => '01-04-1985',
                'gender' => 'Male',
                'address' => 'No 4, Jalan D\'Belsa 5, Taman Bandar Melati',
                'state' => 'Selangor',
                'country' => 'Malaysia',
                'pin_code'  => '76555',
                'phone_number' => '0192649655',
                'department' => 'Information Technology',
                'designation' => 'IT Manager',
                'reports_to' => 'KS',
            ],
            // Add more data as needed
        ];

        DB::table('user')->insert($data);
    }
}
