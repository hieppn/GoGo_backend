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
            'description' =>"- Thùng kín - Kích thước thùng xe: D 2m x R 1.4m x C1.5m",
            'unit_price' =>300000,
            'bonus_price' =>15000,
            'image' => "https://khocontainer.com/wp-content/uploads/2017/04/Suzuki-super-carry-truck-650kg.jpg",
            'payload' =>"650",
        ]);
        DB::table('trucks')->insert([
            'id' => '2',
            'name' => "Tải 750kg",
            'description' =>"- Thùng kín  - Kích thước thùng xe: D2.1m x R 1.5mx C 1.5m",
            'unit_price' =>350000,
            'bonus_price' =>18000,
            'image' => "https://www.xetaidanang.com.vn/Hinh%20CTSP/Hinhduan/5924xe-tai-hoa-khanh.jpg",
            'payload' =>"750",
        ]);
        DB::table('trucks')->insert([
            'id' => '3',
            'name' => "Bán Tải 1 Tấn",
            'description' =>"- Thùng kín - KTTX: D3m x R 1.6mx C 1.6m",
            'unit_price' =>400000,
            'bonus_price' =>20000,
            'image' => "https://xetaicenter.com/wp-content/uploads/2018/06/gi-xe-tai-1-tan.jpg",
            'payload' =>"1000",
        ]);
        DB::table('trucks')->insert([
            'id' => '4',
            'name' => "Tải 1.4 Tấn",
            'description' =>"- Thùng kín- KTTX: D4m x R 1.7mx C 1.7m",
            'unit_price' =>500000,
            'bonus_price' =>20000,
            'image' => "https://oto3.namdinhweb.com/wp-content/uploads/2017/12/xe-tai-isuzu-QKR55F.jpg",
            'payload' =>"1400",
        ]);
        DB::table('trucks')->insert([
            'id' => '5',
            'name' => "Tải 1.9 Tấn",
            'description' =>"- Thùng kín - Kích thước thùng xe: D4.3m x R 1.8m x C 1.8m",
            'unit_price' =>600000,
            'bonus_price' =>22000,
            'image' => "http://www.xetaithegioi.com/upload/product/166834532070.jpg",
            'payload' =>"1900",
        ]);
        DB::table('trucks')->insert([
            'id' => '6',
            'name' => "Xe Tải 2.5T",
            'description' =>"- Thùng kín - Kích thước thùng xe: D4.3m x R 1.8m x C 2m",
            'unit_price' =>800000,
            'bonus_price' =>23000,
            'image' => "https://xetaihyundaivn.com/wp-content/uploads/2015/04/2a.jpg",
            'payload' =>"2500",
        ]);
        DB::table('trucks')->insert([
            'id' => '7',
            'name' => "Tải 5Tấn",
            'description' =>"- Thùng bạt- Kích thước thùng xe: D6m x R 2.2mx C 2.2m",
            'unit_price' =>1000000,
            'bonus_price' =>25000,
            'image' => "https://isuzu24h.com/wp-content/uploads/2019/04/tong-quat-Xe-tai-isuzu-5t-NQR-550-thung-kin-inox-isuzu24h.com_.jpg",
            'payload' =>"5000",
        ]);
        DB::table('trucks')->insert([
            'id' => '8',
            'name' => "Tải 8Tấn",
            'description' =>"- Thùng bạt- Kích thước thùng xe: D9m x R 2.6mx C 2.3m",
            'unit_price' =>1800000,
            'bonus_price' =>28000,
            'image' => "https://xetaihovo.com/Content/Uploads/files/Xe%20t%E1%BA%A3i%20tmt%208%20t%E1%BA%A5n%20th%C3%B9ng%20d%C3%A0i%209_3m-%20c%C3%B3%20th%C3%B9ng.JPG",
            'payload' =>"8000",
        ]);
       
    }
}
