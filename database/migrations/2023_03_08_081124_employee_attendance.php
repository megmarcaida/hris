<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('unique_id');
            $table->integer('in_out_time');
            $table->text('check_type')->nullable();
            $table->integer('verify_code')->nullable();
            $table->text('sensor_id')->nullable();
            $table->text('Memoinfo')->nullable();
            $table->text('WorkCode')->nullable();
            $table->text('sn')->nullable();
            $table->integer('UserExtFmt')->nullable();
            $table->string('mechine_sl')->nullable();
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
        Schema::dropIfExists('employee_attendances');
    }
}
