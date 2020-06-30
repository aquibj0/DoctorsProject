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
            $table->bigIncrements('idSequence');
            $table->string("aaqSrId");
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
