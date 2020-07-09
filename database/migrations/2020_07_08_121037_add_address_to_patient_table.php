<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->string('patAddrLine1', 64);
            $table->string('patAddrLine2', 64);
            $table->string('patCity', 35);
            $table->string('patDistrict', 35);
            $table->string('patState', 35);
            $table->string('patPincode', 6)->nullable();

            $table->string('patCountry', 35);
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->dropColumn('patAddrLine1');
            $table->dropColumn('patAddrLine2');
            $table->dropColumn('patCity');
            $table->dropColumn('patDistrict');
            $table->dropColumn('patState');
            $table->dropColumn('patPincode');
            $table->dropColumn('patCountry');


        });
    }
}
