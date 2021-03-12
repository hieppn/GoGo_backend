<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'full_name' => 'Lương Anh Vinh',
            'email' => 'sender1@gmail.com',
            'password' => Hash::make('sender'),
            'phone' => '0982178313',
            'id_card' => '217832234',
            'birthday' => '2010-01-03',
            'address' => '103/2 E Town 2, Cộng Hòa',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_role'=>'1',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Nguyen Van Thuan',
            'email' => 'sender2@gmail.com',
            'password' => Hash::make('sender'),
            'phone' => '0989178313',
            'id_card' => '207832234',
            'birthday' => '2010-01-04',
            'address' => '103/2 E Town 2, Cộng Hòa',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_role'=>'1',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Hàm Hương',
            'email' => 'trucker1@gmail.com',
            'password' => Hash::make('trucker'),
            'phone' => '0982178312',
            'id_card' => '217832233',
            'birthday' => '2010-01-03',
            'address' => '103/5 E Town 2, Cộng Hòa',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_role'=>'2',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Lương An',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin'),
            'phone' => '0982178311',
            'id_card' => '217832232',
            'birthday' => '2010-01-04',
            'address' => '103/45 E Town 2, Cộng Hòa',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_role'=>'3',
        ]);
    }
}
