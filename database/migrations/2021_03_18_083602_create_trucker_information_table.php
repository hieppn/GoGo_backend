<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateTruckerInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucker_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_trucker')->unsigned()->unique();
            $table->string('id_card_front');
            $table->string('id_card_back');
            $table->string('license_front');
            $table->string('license_back');
            $table->string('license_plate');
            $table->foreign('id_trucker')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('trucker_information');
    }
}
