<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManualPayslips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_payslips', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_number');
            $table->string('email_address');
            $table->string('company_name');
            $table->string('basic_salary');
            $table->string('overtime');
            $table->string('late');
            $table->string('absent');
            $table->string('tax');
            $table->string('sss');
            $table->string('hdmf');
            $table->string('phic');
            $table->string('loan');
            $table->string('other_deduction');
            $table->string('total_gross');
            $table->string('total_deduction');
            $table->string('allowances');
            $table->string('other_credit');
            $table->string('net_pay');
            $table->string('hdmf_loan_balance');
            $table->string('sss_loan_balance');
            $table->string('cut_off_date');
            $table->string('pay_out_date');
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
        Schema::dropIfExists('manual_payslips');
    }
}
