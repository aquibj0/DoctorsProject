<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailedPayementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_payements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_req_id');
            $table->foreign('service_req_id')->references('id')->on('service_request')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
 
            $table->string('payment_transaction_id');
            $table->string('payment_amount');

            $table->string('order_id')->nullable();
            $table->string('code');
            $table->string('description');
            $table->string('source');
            $table->string('step');
            $table->string('reason');
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
        Schema::dropIfExists('failed_payements');
    }
}
