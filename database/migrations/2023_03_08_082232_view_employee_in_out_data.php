<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ViewEmployeeInOutData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_employee_in_out_data', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_attendance_id');
            $table->integer('finger_print_id');
            $table->date('in_time');
            $table->date('out_time');
            $table->date('date');
            $table->time('working_time');
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
        Schema::dropIfExists('view_employee_in_out_data');
    }
}
