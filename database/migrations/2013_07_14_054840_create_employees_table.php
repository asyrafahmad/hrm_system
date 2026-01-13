<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // ✅ REQUIRED PRIMARY KEY

            // Core identity
            $table->string('employee_code', 50)->unique();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone_number', 20)->nullable();
            $table->date('join_date')->nullable();
            $table->string('address', 500)->nullable();

            // Personal info
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            // Organization
            $table->string('company', 255)->nullable();
            $table->string('department', 255)->nullable();
            $table->string('position', 255)->nullable();

            // Status
            $table->enum('status', ['active', 'inactive', 'resigned'])->default('active');

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
        Schema::dropIfExists('employees');
    }
}
