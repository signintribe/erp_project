<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblmaintainOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblmaintain_office', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('office_name');
            $table->string('office_type');
            $table->date('start_date');
            $table->tinyInteger('office_status')->default('0')->comment='0=Inactive; 1=Active';
            $table->string('cost_center_code')->nullable();
            $table->string('profit_center_code')->nullable();
            $table->string('scope_office')->nullable();
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('social_id');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('address_id')->references('id')->on('tbladdresses')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('tblcontacts')->onDelete('cascade');
            $table->foreign('social_id')->references('id')->on('tblsocial_medias')->onDelete('cascade');
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
        Schema::dropIfExists('tblmaintain_office');
    }
}
