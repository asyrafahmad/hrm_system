<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_information', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->string('rec_id')->nullable();
            $table->string('email')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('reports_to')->nullable();

            $table->string('emergency_contact_name_1')->nullable();
            $table->string('emergency_contact_relationship_1')->nullable();
            $table->string('emergency_contact_phone_1')->nullable();
            $table->string('emergency_contact_mobile_1')->nullable();
            $table->string('emergency_contact_name_2')->nullable();
            $table->string('emergency_contact_relationship_2')->nullable();
            $table->string('emergency_contact_phone_2')->nullable();
            $table->string('emergency_contact_mobile_2')->nullable();
            // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_information');
    }
}
