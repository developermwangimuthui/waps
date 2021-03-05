<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_movements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->double('longitude');
            $table->double('latitude');
            $table->string('type');//online offline start stop
            $table->uuid('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
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
        Schema::dropIfExists('driver_movements');
    }
}
