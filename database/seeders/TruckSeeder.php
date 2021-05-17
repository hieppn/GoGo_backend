<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trucks')->insert([
            'id' => '1',
            'name' => "Tải 650kg",
            'description' =>"Thùng kín - Kích thước thùng xe: D 2m x R 1.4m x C1.5m",
            'unit_price' =>300000,
            'bonus_price' =>15000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/avatars/1617867833-cZCbrKKQY9606eb439d5b2d",
            'payload' =>"650",
            'isCheck' => false
        ]);
        DB::table('trucks')->insert([
            'id' => '2',
            'name' => "Tải 750kg",
            'description' =>"Thùng kín  - Kích thước thùng xe: D2.1m x R 1.5mx C 1.5m",
            'unit_price' =>350000,
            'bonus_price' =>18000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/avatars/1617867868-yNnFvKCrUy606eb45c94118",
            'payload' =>"750",
            'isCheck' => false
        ]);
        DB::table('trucks')->insert([
            'id' => '3',
            'name' => "Bán Tải 1 Tấn",
            'description' =>"Thùng kín - KTTX: D3m x R 1.6mx C 1.6m",
            'unit_price' =>400000,
            'bonus_price' =>20000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/avatars/1617867833-cZCbrKKQY9606eb439d5b2d",
            'payload' =>"1000",
            'isCheck' => false
        ]);
        DB::table('trucks')->insert([
            'id' => '4',
            'name' => "Tải 1.4 Tấn",
            'description' =>"Thùng kín- KTTX: D4m x R 1.7mx C 1.7m",
            'unit_price' =>500000,
            'bonus_price' =>20000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/avatars/1617868850-sSmwCndoBt606eb8328f9f6",
            'payload' =>"1400",
            'isCheck' => false
        ]);
        DB::table('trucks')->insert([
            'id' => '5',
            'name' => "Tải 1.9 Tấn",
            'description' =>"Thùng kín - Kích thước thùng xe: D4.3m x R 1.8m x C 1.8m",
            'unit_price' =>600000,
            'bonus_price' =>22000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/trucks/1617870207-zSZAq7ObGg606ebd7fed8a2",
            'payload' =>"1900",
            'isCheck' => false
        ]);
        DB::table('trucks')->insert([
            'id' => '6',
            'name' => "Xe Tải 2.5T",
            'description' =>"Thùng kín - Kích thước thùng xe: D4.3m x R 1.8m x C 2m",
            'unit_price' =>800000,
            'bonus_price' =>23000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/trucks/1620753364-luGJOx2miA609abbd44c8c3",
            'payload' =>"2500",
            'isCheck' => false
        ]);
        DB::table('trucks')->insert([
            'id' => '7',
            'name' => "Tải 5Tấn",
            'description' =>"Thùng bạt- Kích thước thùng xe: D6m x R 2.2mx C 2.2m",
            'unit_price' =>1000000,
            'bonus_price' =>25000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/trucks/1620752630-jSsvXOMUhP609ab8f646bc7",
            'payload' =>"5000",
            'isCheck' => false
        ]);
        DB::table('trucks')->insert([
            'id' => '8',
            'name' => "Tải 8Tấn",
            'description' =>"Thùng bạt- Kích thước thùng xe: D9m x R 2.6mx C 2.3m",
            'unit_price' =>1800000,
            'bonus_price' =>28000,
            'image' => "https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/trucks/1620753391-3qRfTsiZTx609abbefc2d1d",
            'payload' =>"8000",
            'isCheck' => false
        ]);
       
    }
}
