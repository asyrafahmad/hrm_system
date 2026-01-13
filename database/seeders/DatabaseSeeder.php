<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SequenceTableSeeder;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\UserSeeder;


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
            EmployeeSeeder::class,
            UserSeeder::class,
            RolePermissionSeeder::class,
            SequenceTableSeeder::class,
        ]);
    }
}
