<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_appointment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("clinic_id");
            $table->foreign('clinic_id')->references('id')->on('clinic')->onDelete('cascade');
            $table->unsignedBigInteger("service_request_id");
            $table->foreign('service_request_id')->references('id')->on('service_request')->onDelete('cascade');
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
        Schema::dropIfExists('clinic_appointment');
    }
}
