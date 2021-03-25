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
            'phone' => '0984036282',
            'id_card' => '215484707',
            'birthday' => '2010-01-03',
            'address' => '103/2 E Town 2, Cộng Hòa',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_role'=>'1',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Trần Công Dũng',
            'email' => 'sender2@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0985582807',
            'id_card' => '207832234',
            'birthday' => '2010-01-04',
            'address' => 'Thăng Bình, Quảng Nam',
            'avatar' => 'https://scontent-itm1-1.xx.fbcdn.net/v/t1.0-9/160568005_2981102682124691_103298220570549948_o.jpg?_nc_cat=104&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=ViDhRsQX4bgAX8IsNGz&_nc_ht=scontent-itm1-1.xx&oh=b723e91deb33880e5ab980104babc08e&oe=60817460',
            'id_role'=>'1',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Cao Ngọc Tàu',
            'email' => 'trucker1@gmail.com',
            'password' => Hash::make('taucao12'),
            'phone' => '0353956450',
            'id_card' => '217832233',
            'birthday' => '2010-01-03',
            'address' => 'Lệ Thủy, Quảng Bình',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_role'=>'2',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Bùi Hữu Hiệp',
            'email' => 'buihuuhiepdev@gmail.com',
            'password' => Hash::make('admin'),
            'phone' => '0981536770',
            'id_card' => '215485709',
            'birthday' => '2010-06-25',
            'address' => '101B Lê Hữu Trác, Phước Mỹ, Sơn Trà, Đà Nẵng',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_role'=>'3',
        ]);
    }
}
