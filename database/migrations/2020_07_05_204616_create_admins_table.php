<?php
// 5.4, 5.5, 5.6

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('intuId')->nullable();
          $table->string('firstName');
          $table->string('lastName');
          $table->string('phoneNo')->unique()->nullable();
          $table->string('degree')->nullable()->nullable();
          $table->string('category')->nullable();
          $table->string('gender')->nullable();
          $table->string('salutation')->nullable();
          $table->string('department')->nullable();
          $table->date('dob')->nullable();
          $table->string('alternatePhoneNo')->nullable()->nullable();
          $table->string('addressLine1')->nullable();
          $table->string('addressLine2')->nullable();
          $table->string('city')->nullable();
          $table->string('district')->nullable();
          $table->string('state')->nullable();
          $table->string('country')->nullable();
          $table->string('email')->unique();
          $table->string('password');
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
        Schema::dropIfExists('admins');
    }
}