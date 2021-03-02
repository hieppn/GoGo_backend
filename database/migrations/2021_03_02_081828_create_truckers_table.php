<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truckers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('id_card')->unique();
            $table->timestamp('birthday');
            $table->string('address');
            $table->string('driving_license')->unique();
            $table->string('license_plate')->unique();
            $table->string('email')->unique();
            $table->Integer('phone');
            $table->string('password');
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
        Schema::dropIfExists('truckers');
    }
}
