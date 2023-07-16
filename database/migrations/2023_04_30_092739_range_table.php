<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('range_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('deduction_credit_id');
            $table->string('type');
            $table->string('name');
            $table->string('bracket')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('percentage')->nullable();
            $table->string('fixed_tax')->nullable();
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
        Schema::dropIfExists('range_tables');
    }
}
