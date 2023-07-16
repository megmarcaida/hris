<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GeneratedPayslips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generated_payslips', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('month_of_salary')->nullable();
            $table->decimal('basic_salary')->default(0);
            $table->decimal('total_allowance')->default(0);
            $table->decimal('total_deduction')->default(0);
            $table->decimal('total_late')->default(0);
            $table->decimal('total_late_amount')->default(0);
            $table->decimal('total_absence')->default(0);
            $table->decimal('total_absence_amount')->default(0);
            $table->decimal('overtime_rate')->default(0);
            $table->decimal('total_over_time_hour')->default(0);
            $table->decimal('total_overtime_amount')->default(0);
            $table->decimal('hourly_rate')->default(0);
            $table->decimal('total_present')->default(0);
            $table->decimal('total_leave')->default(0);
            $table->decimal('total_working_days')->default(0);
            $table->decimal('tax')->default(0);
            $table->decimal('gross_salary')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('status')->default(0);
            $table->text('comment')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('action')->nullable();
            $table->decimal('per_day_salary')->default(0);
            $table->decimal('taxable_salary')->default(0);
            $table->decimal('net_salary')->default(0);  
            $table->string('working_hour')->nullable();
            $table->decimal('sss')->default(0);
            $table->decimal('hdmf')->default(0);
            $table->decimal('philhealth')->default(0);
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
        Schema::dropIfExists('generated_payslips');
    }
}
