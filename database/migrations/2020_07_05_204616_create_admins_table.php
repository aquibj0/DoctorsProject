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
          $table->string('intuId');
          $table->string('firstName');
          $table->string('lastName');
          $table->string('phoneNo')->unique();
          $table->string('degree')->nullable();
          $table->string('category');
          $table->string('gender');
          $table->string('salutation');
          $table->string('department');
          $table->date('dob');
          $table->string('alternatePhoneNo')->nullable();
          $table->string('addressLine1');
          $table->string('addressLine2')->nullable();
          $table->string('city');
          $table->string('district');
          $table->string('state');
          $table->string('country');
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