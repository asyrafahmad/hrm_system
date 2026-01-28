<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('users')->insert([
    //         [
    //             'username' => 'Super Admin',
    //             'email' => 'superadmin@gmail.com',
    //             'password' => bcrypt('Superadmin123!'),
    //             // 'employee_id' => 1,
    //             // 'avatar' => null,
    //             // 'user_role_types_id' => 1,
    //             'user_status_id' => 1,
    //             'email_verified_at' => now(),
    //         ],
    //         [
    //             'username' => 'HR Admin',
    //             'email' => 'hr@gmail.com',
    //             'password' => bcrypt('Hradmin123!'),
    //             // 'employee_id' => 2,
    //             // 'avatar' => null,
    //             // 'user_role_types_id' => 2,
    //             'user_status_id' => 1,
    //             'email_verified_at' => now(),
    //         ],
    //         [
    //             'username' => 'Employee',
    //             'email' => 'user@gmail.com',
    //             'password' => bcrypt('User123!'),
    //             // 'employee_id' => 3,
    //             // 'avatar' => null,
    //             // 'user_role_types_id' => 3,
    //             'user_status_id' => 1,
    //             'email_verified_at' => now(),
    //         ],
    //     ]);
    // }

    public function run()
    {
        // Users data
        $users = [
            [
                'username' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => 'Superadmin123!',
                'role' => 'Super Admin',
            ],
            [
                'username' => 'HR Admin',
                'email' => 'hr@gmail.com',
                'password' => 'Hradmin123!',
                'role' => 'HR',
            ],
            [
                'username' => 'Employee',
                'email' => 'user@gmail.com',
                'password' => 'User123!',
                'role' => 'Employee',
            ],
        ];

        foreach ($users as $userData) {
            // Create user
            $user = User::firstOrCreate(
                ['email' => $userData['email']], // avoid duplicate
                [
                    'username' => $userData['username'],
                    'password' => bcrypt($userData['password']),
                    'user_status_id' => 1,
                    'email_verified_at' => now(),
                ]
            );

            // Assign role
            $user->syncRoles($userData['role']);
        }
    }
}
