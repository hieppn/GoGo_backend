<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class SenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * $table->increments('id');
     *
     * @return void
     */
    public function run()
    {
        DB::table('senders')->insert([
            'full_name' => 'Lương Anh Vũ',
            'email' => 'sender1@gmail.com',
            'password' => Hash::make('sender'),
            'phone' => '0982178312',
            'id_card' => '217832046',
            'birthday' => '2010-01-03',
            'address' => '102/2 Etown2, Cộng Hòa',
            'tax_code' => 'ADX1234',


        ]);
    }
}
