<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => '1',
            'name_role' => 'Sender',
        ]);
        DB::table('roles')->insert([
            'id' => '2',
            'name_role' => 'Trucker',
        ]);
        DB::table('roles')->insert([
            'id' => '3',
            'name_role' => 'Admin',
        ]);
    }
}
