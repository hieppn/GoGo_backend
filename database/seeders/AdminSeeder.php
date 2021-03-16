<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Hàm Hương',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'phone' => '0982178362',
        ]);
        DB::table('admins')->insert([
            'name' => 'Hàm Hương Em',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin'),
            'phone' => '0982178361',
        ]);
    }
}
