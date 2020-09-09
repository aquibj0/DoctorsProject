<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patId')->unique()->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('patFirstName');
            $table->string('patLastName');
            $table->string('patGender');
            $table->integer('patAge');
            $table->string("patMobileCC");
            $table->string("patMobileNo");
            $table->string("patEmail");
            $table->string("patAddrLine1");
            $table->string("patAddrLine2")->nullable()->default(null);
            $table->string("patCity");
            $table->string("patDistrict")->nullable()->default(null);
            $table->string("patState");
            $table->string("patCountry");
            $table->integer('pincode')->nullable()->default(null);
            $table->text("patBackground");
            $table->text("patPhotoFileNameLink")->nullable();
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
        Schema::dropIfExists('patient_details');
    }
}
