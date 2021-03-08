<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
