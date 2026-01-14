<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRoleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('user_role_types', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->nullable();
        //     $table->timestamps();
        // });

        // DB::table('user_role_types')->insert([
        //     ['name' => 'Admin'],
        //     ['name' => 'Super Admin'],
        //     ['name' => 'Normal User'],
        //     ['name' => 'Client'],
        //     ['name' => 'Employee']
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role_types');
    }
}
