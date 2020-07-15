<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("clinicType")->nullable();
            $table->string("clinicName");
            $table->integer("clinicMobileNo");
            $table->string("clinicLandLineNo");
            $table->string("clinicAddressLine1", 64);
            $table->string("clinicAddressLine2", 64)->nullable();
            $table->string("clinicCity", 35);
            $table->string("clinicDistrict", 35);
            $table->string("clinicState", 35);
            $table->string("clinicCountry", 35);
            $table->integer("clinicPincode");
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
        Schema::dropIfExists('clinic');
    }
}
