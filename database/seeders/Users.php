<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
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
                'join_date' => '01-01-1970',
                'phone_number' => '0192675696',
                'status' => 'Active',
                'role_name' => 'Admin',
                'avatar' => 'photo_defaults.jpg',
                'position'  => 'Admin',
                'department' => 'Human Resource Department',
                'password' => '$2y$10$eKvZqKqdU37aYirotqron.aZsVUFPgkzq2.z8vhNPFDhJ1GqT5f8m',
            ],
            [
                'name' => 'Muhammad Nur Asyraf',
                'rec_id' => 'Staff_ID_00001',
                'email' => 'asyraf@gmail.com',
                'join_date' => '01-04-2023',
                'phone_number' => '0192649693',
                'status' => 'Active',
                'role_name' => 'Employee',
                'avatar' => 'photo_defaults.jpg',
                'position'  => 'Web Developer',
                'department' => 'Information Technology',
                'password' => '$2y$10$9RJbj0qdOgeY0WZdDqQNCOZh4HtsAZ1SzP9AgsWBoB0LWfnEl3rR6',
            ],
            [
                'name' => 'Bexter Lim',
                'rec_id' => 'Staff_ID_00002',
                'email' => 'bexter@gmail.com',
                'join_date' => '02-04-2023',
                'phone_number' => '0192649456',
                'status' => 'Active',
                'role_name' => 'Employee',
                'avatar' => 'photo_defaults.jpg',
                'position'  => 'IT Manager',
                'department' => 'Information Technology',
                'password' => '$2y$10$f3K8mureSaftH5auzuLwk.tGs/kpS67dwSxcbo8GWoKItcAjWjHqy',
            ],
            [
                'name' => 'Hafiz',
                'rec_id' => 'Staff_ID_00003',
                'email' => 'hafiz@gmail.com',
                'join_date' => '03-04-2023',
                'phone_number' => '0192649622',
                'status' => 'Active',
                'role_name' => 'Employee',
                'avatar' => 'photo_defaults.jpg',
                'position'  => 'Infrastructure',
                'department' => 'Information Technology',
                'password' => '$2y$10$m5YQfOIPd2ldV2Liy1pXnOPzRpJQilqpwjs83LKsa2zy5rF1zUOSW',
            ],
            // Add more data as needed
        ];

        DB::table('users')->insert($data);
    }
}
