<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('positions')->insert([
            ['name' => 'CEO'],
            ['name' => 'CFO'],
            ['name' => 'CTO'],
            ['name' => 'Manager'],
            ['name' => 'Web Designer'],
            ['name' => 'Web Developer'],
            ['name' => 'Android Developer'],
            ['name' => 'IOS Developer'],
            ['name' => 'Team Leader'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
