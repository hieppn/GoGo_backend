<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
class TruckerTemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trucker_tempts')->insert([
            'full_name' => 'Nguyễn Duy Ngọc',
            'email' => 'nguyenngoc2000hbt@gmail.com',
            'password' => Hash::make('duyngoc2k'),
            'phone' => '0981536778',
            'id_card' => '1234567123',
            'birthday' => '2000-08-23',
            'address' => '101B Lê Hữu Trác, Phước Mỹ, Sơn Mỹ, Đà Nẵng',
            'avatar' => 'https://media-cdn.laodong.vn/storage/newsportal/2021/6/15/920685/Blackpink.jpg?w=414&h=276&crop=auto&scale=both',
            'id_card_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'id_card_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_plate' => '77 H1 5678',
            'id_role' => 2,
            'registration_paper' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'car_type'=>'Xe 3 bánh',
            'payload' => '3.6'
        ]);
    }
}
