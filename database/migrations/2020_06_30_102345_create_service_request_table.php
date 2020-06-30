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
            $table->bigIncrements('idSequence');
            $table->string("srId");
            $table->integer("srSrvcId");
            $table->string("srPatientId");
            $table->string("srUserId");
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
