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
            $table->bigIncrements('idSequence');
            $table->string('userId');
            $table->string('userType');
            $table->string('userFirstName');
            $table->string('userLastName');
            $table->string('userEmail')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('userPassword');
            $table->string('userMobileNo')->unique();
            $table->string('userStatus');
            $table->string('userLandLineNo');
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
