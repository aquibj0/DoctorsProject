<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userId')->unique()->nullable();
            $table->string('userType')->nullable();
            $table->string('userFirstName');
            $table->string('userLastName');
            $table->string('userEmail')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('userPassword');
            $table->string('userMobileNo')->unique();
            $table->string('userStatus')->nullable();
            $table->string('userLandLineNo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
