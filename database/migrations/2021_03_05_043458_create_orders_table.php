<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('send_from');
            $table->string('send_to');
            $table->string('time_send');
            $table->string('name');
            $table->Integer('mass');
            $table->string('image');
            $table->integer('type')->default(1);
            $table->boolean('export_data')->default(false);
            $table->text('sender_info');
            $table->text('receiver_info');
            $table->integer('price');
            $table->boolean('insurance_fee');
            $table->integer('id_truck')->unsigned();
            $table->float('distance');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_truck')->references('id')->on('trucks')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
