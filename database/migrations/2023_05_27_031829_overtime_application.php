<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OvertimeApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtime_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('employee_no');
            $table->string('department');
            $table->string('date')->nullable();
            $table->string('actual_log')->nullable();
            $table->string('no_of_hours')->nullable();
            $table->string('reason_of_ot')->nullable();
            $table->string('department_head')->nullable();
            $table->string('immediate_supervisor')->nullable();
            $table->string('hrd')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('overtime_applications');
    }
}
