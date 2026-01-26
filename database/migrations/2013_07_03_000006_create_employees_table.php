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

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('employee_code', 50)->unique();
            $table->string('fullname', 255);
            $table->string('email', 255)->unique();
            $table->string('ic_number', 255);
            $table->string('join_date',100)->nullable()->default('1970-01-01');
            $table->string('avatar')->nullable();

            // Personal info
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('phone_number', 20)->nullable();

            // Organization
            $table->string('company', 255)->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained()->nullOnDelete();

            // Status
            $table->enum('status', ['1', '2', '3'])->default('1'); // 1 = Active, 2 = Inactive, 3 = Resigned

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
