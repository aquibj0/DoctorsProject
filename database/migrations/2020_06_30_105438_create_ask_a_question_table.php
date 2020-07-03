<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAskAQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_a_question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("service_req_id");
            $table->foreign('service_req_id')->references('id')->on('service_request')->onDelete('cascade');
            $table->string("aaqPatientBackground");
            $table->string("aaqQuestionText");
            $table->string("aaqDocResponse");
            $table->string("aaqDocResponseUploaded");
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
        Schema::dropIfExists('ask_a_question');
    }
}
