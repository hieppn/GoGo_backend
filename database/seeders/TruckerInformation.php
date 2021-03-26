<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TruckerInformation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trucker_information')->insert([
        'id_trucker' =>3 ,
        'id_card_front' => 'https://xuatkhaulaodongdl.com/wp-content/uploads/2017/05/cmnd-hople-chua-hop-le.jpg',
        'id_card_back' => 'https://i.pinimg.com/originals/0e/a6/07/0ea60749572d399218b842931f892f86.jpg',
        'license_front' => 'https://timviec365.vn/pictures/images/giay-phep-lai-xe-hang-d1.jpg',
        'license_back' => 'https://photo-cms-plo.zadn.vn/w653/Uploaded/2021/chuobun/2018_10_25/giay-phep-lai-xe-b1_qprp_thumb.png',
        'license_plate' => '77 H1 5678',
        'registration_paper'=>'https://img1.oto.com.vn/2019/03/21/2nYr5R9Z/dang-kiem-xe-oto-khi-mat-giay-chung-nhan-oto-com-v-cbbb.jpg',
        'car_type' =>'Xe 3 bánh',
        'payload' => 3.6
        ]);
    }
}
