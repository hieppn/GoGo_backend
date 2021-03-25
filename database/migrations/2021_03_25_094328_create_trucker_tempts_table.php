<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckerTemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucker_tempts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('id_card');
            $table->date('birthday')->format('Y/m/d');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('avatar');
            $table->string('id_card_front');
            $table->string('id_card_back');
            $table->string('license_front');
            $table->string('license_back');
            $table->string('license_plate');
            $table->integer('id_role');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trucker_tempts');
    }
}
