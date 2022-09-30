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
            $table->integer('company_id');
            $table->string('pay_type');
            $table->string('pay_emp_account');
            $table->string('pay_amount');
            $table->string('pay_com_account');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('company_id')->references('id')->on('tblcompanydetails')->onDelete('cascade');
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
