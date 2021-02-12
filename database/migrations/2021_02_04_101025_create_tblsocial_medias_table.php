<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblsocialMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblsocial_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('website');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('linkedin');
            $table->string('pinterest');
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
        Schema::dropIfExists('tblsocial_medias');
    }
}
