<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_allowances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('allowance_type');
            $table->integer('allow_emp_account');
            $table->integer('allow_amount');
            $table->integer('allow_com_account');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('allow_emp_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
            $table->foreign('allow_com_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
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
        Schema::dropIfExists('erp_allowances');
    }
}
