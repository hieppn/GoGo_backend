<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bills')->insert([
            'id_order'=>1,
            'id_user'=>1,
        ]);
    }
}
