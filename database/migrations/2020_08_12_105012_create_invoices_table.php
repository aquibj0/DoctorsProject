<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("service_request_id");
            $table->foreign('service_request_id')->references('id')->on('service_request')->onDelete('cascade');
            $table->string('invoice_number')->unique()->nullable();
            $table->date('invoice_date');
            $table->string('patient_name');
            $table->string('patient_address_line1');
            $table->string('patient_address_line2')->nullable()->default(null);
            $table->string('patient_city');
            $table->string('patient_district')->nullable()->default(null);
            $table->string('patient_country');
            $table->string('service_name');
            $table->string('service_price');
            $table->string('service_amount');
            $table->string('service_quantity')->default(1);
            $table->string('doctor_name');
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
        Schema::dropIfExists('invoices');
    }
}
