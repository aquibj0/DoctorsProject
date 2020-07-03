<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternalUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("intuId");
            $table->string("intuUserCategory");
            $table->string("intuGender");
            $table->string("intuSalutation");
            $table->string("intuDegree");
            $table->string("intuDept");
            $table->date("intuDob");
            $table->string("intuAlternateNo");
            $table->string("intuAddressId");
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
        Schema::dropIfExists('internal_user');
    }
}
