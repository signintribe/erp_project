<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_allowances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('erp_payrolls_id')->unsigned();
            $table->integer('tblemployeeinformation_id');
            $table->integer('erp_allowances_id')->unsigned();
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('tblemployeeinformation_id')->references('id')->on('tblemployeeinformations')->onDelete('cascade');
            $table->foreign('erp_allowances_id')->references('id')->on('erp_allowances')->onDelete('cascade');
            $table->foreign('erp_payrolls_id')->references('id')->on('erp_payrolls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_allowances');
    }
}
