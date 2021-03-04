<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class TruckerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('truckers')->insert([
            'full_name' => 'Lương Anh Vinh',
            'email' => 'trucker1@gmail.com',
            'password' => Hash::make('trucker'),
            'phone' => '0982178313',
            'id_card' => '217832234',
            'birthday' => '2010-01-03',
            'address' => '103/2 Etown2, Cộng Hòa',
            'driving_license' => 'AX32982',
            'license_plate' => '77H-9999',

            // $table->increments('id');
            // $table->string('full_name');
            // $table->string('id_card')->unique();
            // $table->timestamp('birthday');
            // $table->string('address');
            // $table->string('driving_license')->unique();
            // $table->string('license_plate')->unique();
            // $table->string('email')->unique();
            // $table->Integer('phone');
            // $table->string('password');
        ]);
    }
}
