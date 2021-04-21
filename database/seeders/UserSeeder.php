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
            'email' => 'buihuuhiep2562k@gmail.com',
            'password' => Hash::make('sender'),
            'phone' => '0984036282',
            'id_card' => '215484707',
            'birthday' => '2000-01-03',
            'amount'=> 0,
            'address' => '103/2 E Town 2, Cộng Hòa',
            'avatar' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994398-401v5qCA8I607fe4dec3cfd',
            'id_role'=>'1',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Trần Công Dũng',
            'email' => 'trancongdung.dev@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0985582807',
            'id_card' => '207832234',
            'birthday' => '2000-01-04',
            'amount'=> 0,
            'address' => 'Thăng Bình, Quảng Nam',
            'avatar' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994398-401v5qCA8I607fe4dec3cfd',
            'id_role'=>'1',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Cao Ngọc Tàu',
            'email' => 'trucker1@gmail.com',
            'password' => Hash::make('taucao12'),
            'phone' => '0353956450',
            'id_card' => '217832233',
            'amount'=> 0,
            'birthday' => '2000-01-03',
            'address' => 'Lệ Thủy, Quảng Bình',
            'avatar' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994220-9O5uj0QPMl607fe42c2468c',
            'id_role'=>'2',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Anh Dũng',
            'email' => 'trancongdung12@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0985582806',
            'id_card' => '215498705',
            'amount'=> 0,
            'birthday' => '2000-01-01',
            'address' => 'Lệ Thủy, Quảng Bình',
            'avatar' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994220-9O5uj0QPMl607fe42c2468c',
            'id_role'=>'2',
        ]);
        DB::table('users')->insert([
            'full_name' => 'Bùi Hữu Hiệp',
            'email' => 'buihuuhiepdev@gmail.com',
            'password' => Hash::make('admin'),
            'phone' => '0981536770',
            'id_card' => '215485709',
            'amount'=> 0,
            'birthday' => '2000-06-25',
            'address' => '101B Lê Hữu Trác, Phước Mỹ, Sơn Trà, Đà Nẵng',
            'avatar' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994090-dFKdW03ync607fe3aa9bc7d',
            'id_role'=>'3',
        ]);
    }
}
