<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeductionValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deduction_values', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('deduction_id');
            $table->string('field_name');
            $table->string('value');
            $table->string('type');
            $table->string('tax');
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
        Schema::dropIfExists('deduction_values');
    }
}
