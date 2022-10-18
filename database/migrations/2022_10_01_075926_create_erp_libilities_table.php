<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpLibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_libilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('libility_type');
            $table->integer('libility_emp_account');
            $table->integer('libility_amount');
            $table->integer('libility_com_account');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('libility_emp_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
            $table->foreign('libility_com_account')->references('id')->on('tblaccountcategories')->onDelete('cascade');
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
        Schema::dropIfExists('erp_libilities');
    }
}
