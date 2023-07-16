<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('unique_id');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('branch_id');
            $table->integer('supervisor_id');
            $table->integer('work_shift_id');
            $table->integer('salary_id');
            $table->integer('hourly_salaries_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->date('date_of_joining');
            $table->date('date_of_leaving')->nullable();
            $table->string('gender');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('photo')->nullable();
            $table->string('address');
            $table->string('emergency_contacts');
            $table->string('phone');
            $table->integer('status');
            $table->integer('permanent_status');
            $table->integer('created_by');
            $table->integer('updated_by');
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
