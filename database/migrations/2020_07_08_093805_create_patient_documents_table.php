<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documentType', 16);
            $table->string('documentDescription', 35)->nullable();
            $table->date('documentDate');
            $table->string('documentFileName', 255);
            $table->date('documentUploadDate');
            $table->string('documentUploadedBy', 16);
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
        Schema::dropIfExists('patient_documents');
    }
}
