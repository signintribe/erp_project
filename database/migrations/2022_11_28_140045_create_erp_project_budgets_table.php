<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpProjectBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_project_budgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('erp_company_budget_id');
            $table->integer('erp_tasks_assigned_detail_id');
            $table->timestamps();

            $table->foreign('erp_company_budget_id')->references('id')->on('erp_company_budgets')->onDelete('cascade');
            $table->foreign('erp_tasks_assigned_detail_id')->references('id')->on('erp_tasks_assigned_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('erp_project_budgets');
    }
}
