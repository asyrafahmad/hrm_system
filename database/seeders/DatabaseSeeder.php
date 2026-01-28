<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SequenceTableSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProfileInformationSeeder;
use Database\Seeders\UserRoleTypeSeeder;
use Database\Seeders\UserStatusSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            // UserRoleTypeSeeder::class,
            // UserStatusSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            EmployeeSeeder::class,
            ProfileInformationSeeder::class,
            SequenceTableSeeder::class,
        ]);
    }
}
