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
            $table->string('employee_id')->nullable();
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
            $table->timestamps();

            //Emergency Contact
            $table->string('emergency_contact_name_1')->nullable();
            $table->string('emergency_contact_relationship_1')->nullable();
            $table->string('emergency_contact_phone_1')->nullable();
            $table->string('emergency_contact_mobile_1')->nullable();
            $table->string('emergency_contact_name_2')->nullable();
            $table->string('emergency_contact_relationship_2')->nullable();
            $table->string('emergency_contact_phone_2')->nullable();
            $table->string('emergency_contact_mobile_2')->nullable();

            // Personal Informations
            $table->string('passport_no')->nullable();
            $table->string('passport_expired_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('employment_of_spouse')->nullable();
            $table->string('no_of_children')->nullable();

            // Personal Informations
            $table->string('family_member_name_1')->nullable();
            $table->string('family_member_relationship_1')->nullable();
            $table->string('family_member_DOB_1')->nullable();
            $table->string('family_member_phone_1')->nullable();

            // Bank Informations
            $table->string('bank_name')->nullable();
            $table->string('bank_account_no')->nullable();
            
            // Academic Informations
            $table->string('academic_institution_1')->nullable();
            $table->string('academic_qualification_1')->nullable();
            $table->string('academic_type_qualification_1')->nullable();
            $table->string('academic_grade_1')->nullable();
            $table->string('academic_starting_date_1')->nullable();
            $table->string('academic_complete_date_1')->nullable();
            $table->string('academic_institution_2')->nullable();
            $table->string('academic_qualification_2')->nullable();
            $table->string('academic_type_qualification_2')->nullable();
            $table->string('academic_grade_2')->nullable();
            $table->string('academic_starting_date_2')->nullable();
            $table->string('academic_complete_date_2')->nullable();
            
            // Experience Informations
            $table->string('exp_company_name_1')->nullable();
            $table->string('exp_location_1')->nullable();
            $table->string('exp_position_1')->nullable();
            $table->string('exp_period_from_1')->nullable();
            $table->string('exp_period_to_1')->nullable();
            $table->string('exp_company_name_2')->nullable();
            $table->string('exp_location_2')->nullable();
            $table->string('exp_position_2')->nullable();
            $table->string('exp_period_from_2')->nullable();
            $table->string('exp_period_to_2')->nullable();
            
            // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
