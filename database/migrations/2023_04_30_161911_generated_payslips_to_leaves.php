<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GeneratedPayslipsToLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generated_payslips_to_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('generated_payslips_id');
            $table->integer('leave_id');
            $table->string('num_of_day')->nullable();
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
        Schema::dropIfExists('generated_payslips_to_leaves');
    }
}
