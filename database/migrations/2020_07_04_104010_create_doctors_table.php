<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('drFirstName');
            $table->string('drLastName');
            $table->string('drEmail');
            $table->string('drPhone');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('address')->onCascade('restrict');
            $table->string('drDegree');
            $table->string('drSalutation');
            $table->string('drAlternateNo')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
