<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("vcSrId")->unique();
            $table->string('vcCallScheduled', 2);
            $table->string('vcDocInternalNotesText', 1024)->nullable();
            $table->string('vcDocPrescriptionUploaded', 2);
            $table->string('vcCallScheduledDtl', 255);
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
        Schema::dropIfExists('video_calls');
    }
}
