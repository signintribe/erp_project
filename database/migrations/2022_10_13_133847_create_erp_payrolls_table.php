<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpPayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payroll_type');
            $table->integer('company_id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('office_id')->unsigned();
            $table->integer('department_id');
            $table->integer('group_id')->unsigned();
            $table->string('payment_type');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('office_id')->references('id')->on('tblmaintain_offices')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('tbldepartmens')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('tblcompanydetails')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('erp_employee_groups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('erp_payrolls');
    }
}
