<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_deductions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('erp_payroll_id')->unsigned();
            $table->integer('tblemployeeinformation_id');
            $table->integer('erp_deduction_id')->unsigned();
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('tblemployeeinformation_id')->references('id')->on('tblemployeeinformations')->onDelete('cascade');
            $table->foreign('erp_deduction_id')->references('id')->on('erp_deductions')->onDelete('cascade');
            $table->foreign('erp_payroll_id')->references('id')->on('erp_payrolls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_deductions');
    }
}
