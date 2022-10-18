<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_deductions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('deduct_type');
            $table->integer('deduct_emp_account');
            $table->integer('deduct_amount');
            $table->integer('deduct_com_account');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('deduct_emp_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
            $table->foreign('deduct_com_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('erp_pay_allowances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('erp_deductions');
    }
}
