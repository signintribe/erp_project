<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('erp_payrolls_id')->unsigned();
            $table->integer('tblemployeeinformation_id');
            $table->integer('erp_pays_id')->unsigned();
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('tblemployeeinformation_id')->references('id')->on('tblemployeeinformations')->onDelete('cascade');
            $table->foreign('erp_pays_id')->references('id')->on('erp_pays')->onDelete('cascade');
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
        Schema::dropIfExists('payroll_pays');
    }
}
