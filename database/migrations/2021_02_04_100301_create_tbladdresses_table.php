<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbladdressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbladdresses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('address_line_1');
            $table->text('address_line_2')->nullable();
            $table->text('address_line_3')->nullable();
            $table->string('street')->nullable();
            $table->string('sector')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbladdresses');
    }
}
