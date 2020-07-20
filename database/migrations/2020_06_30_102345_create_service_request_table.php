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
            $table->string("srId")->unique()->nullable();
            
            $table->unsignedBigInteger("service_id");
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->unsignedBigInteger("patient_id");
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

            $table->datetime("srRecievedDateTime");
            $table->datetime("srDueDateTime");
            $table->datetime("srResponseDateTime")->nullable();
            $table->string("srDepartment");
            $table->string("srAssignedIntUserId")->nullable();
            $table->string("srConfirmationSentByAdmin");
            $table->datetime("srMailSmsSent")->nullable();
            $table->datetime("srConfMailSent")->nullable();
            $table->string("srStatus");
            $table->string("srDocumentUploadedFlag");
            $table->integer("srAppmntId")->nullable();
            $table->string("srCancelFlag")->nullable();
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
