<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('user_type');//1 admin, 2 Driver, 3 Customer
            $table->string('first_name');
            $table->string('surname');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('last_seen')->nullable();
            $table->string('profile_pic_path')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
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
