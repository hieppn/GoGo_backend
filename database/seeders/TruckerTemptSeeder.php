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
            'id_card' => '23234869847',
            'birthday' => '2000-08-23',
            'address' => '101B Lê Hữu Trác, Phước Mỹ, Sơn Mỹ, Đà Nẵng',
            'avatar' => 'https://scontent.fhan5-3.fna.fbcdn.net/v/t1.0-9/144683952_522331092073739_5616458164495207025_o.jpg?_nc_cat=106&ccb=3&_nc_sid=09cbfe&_nc_ohc=NW9fJbQ8P9EAX85Nzo5&_nc_ht=scontent.fhan5-3.fna&oh=b747dd90ff6333d621afa9fb10b971e9&oe=606605C8',
            'id_card_front' => 'https://xuatkhaulaodongdl.com/wp-content/uploads/2017/05/cmnd-hople-chua-hop-le.jpg',
            'id_card_back' => 'https://i.pinimg.com/originals/0e/a6/07/0ea60749572d399218b842931f892f86.jpg',
            'license_front' => 'https://timviec365.vn/pictures/images/giay-phep-lai-xe-hang-d1.jpg',
            'license_back' => 'https://photo-cms-plo.zadn.vn/w653/Uploaded/2021/chuobun/2018_10_25/giay-phep-lai-xe-b1_qprp_thumb.png',
            'license_plate' => '77 H1 5678',
            'id_role' => 2,
            'registration_paper' => 'https://cdn.baogiaothong.vn/files/tung.le/2017/09/29/092924-chup-anh-khi-dang-kiem.jpg',
            'car_type'=>'Xe 3 bánh',
            'payload' => '3.6'
        ]);
    }
}
