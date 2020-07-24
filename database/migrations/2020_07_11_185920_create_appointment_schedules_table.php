<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_schedules', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('appmntType', 3);
            $table->integer('appmntClinicid')->nullable();
            $table->date('appmntDate');
            $table->time('appmntSlot');
            $table->integer('appmntSlotMaxCount');
            $table->integer('appmntSlotFreeCount');
            $table->integer('appmntFlag');
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
        Schema::dropIfExists('appointment_schedules');
    }
}
