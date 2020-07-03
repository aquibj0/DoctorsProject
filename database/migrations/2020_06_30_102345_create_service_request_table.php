<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("srId")->unique();

            $table->unsignedBigInteger("service_id");
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->unsignedBigInteger("patient_id");
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->datetime("srRecievedDateTime");
            $table->datetime("srDueDateTime");
            $table->datetime("srResponseDateTime");
            $table->string("srDepartment");
            $table->string("srAssignedIntUserId");
            $table->string("srConfirmationSentByAdmin");
            $table->datetime("srMail-SmsSent");
            $table->datetime("srConfMailSent");
            $table->string("srStatus");
            $table->string("srDocumentUploadedFlag");
            $table->integer("srAppmntId");
            $table->string("srCancelFlag");
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
        Schema::dropIfExists('service_request');
    }
}
