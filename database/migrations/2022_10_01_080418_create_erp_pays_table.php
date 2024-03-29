<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('pay_type');
            $table->integer('pay_emp_account');
            $table->integer('pay_amount');
            $table->integer('pay_com_account');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('pay_emp_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
            $table->foreign('pay_com_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
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
        Schema::dropIfExists('erp_pays');
    }
}
