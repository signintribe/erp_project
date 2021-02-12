<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblcompanyRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblcompany_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('registration_id');
            $table->string('registration_name');
            $table->string('registration_authority');
            $table->string('registration_date');
            $table->string('expiry_date');
            $table->string('registration_authority_address');
            $table->string('website');
            $table->string('email');
            $table->string('phone_number');
            $table->string('mobile_number');
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
        Schema::dropIfExists('tblcompany_registrations');
    }
}
