<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeaveApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('employee_no');
            $table->string('position');
            $table->string('department');
            $table->string('no_of_days')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('reason')->nullable();
            $table->string('leave_type')->nullable();
            $table->string('offset_date')->nullable();
            $table->string('is_cleared')->nullable();
            $table->string('cleared_by')->nullable();
            $table->string('medical_certificate')->nullable();
            $table->string('undertime_no_of_hours')->nullable();
            $table->string('undertime_date')->nullable();
            $table->string('undertime_approved_by')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('reviewed_by')->nullable();
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
        Schema::dropIfExists('leave_applications');
    }
}
