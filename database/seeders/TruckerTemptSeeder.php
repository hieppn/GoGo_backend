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
            'avatar' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994220-9O5uj0QPMl607fe42c2468c',
            'id_card_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618993610-Ya6QMTH4UL607fe1ca59fd8',
            'id_card_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994660-FtNzAahtNU607fe5e429659',
            'license_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994744-Fl8YT1cAhy607fe6381dffc',
            'license_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994835-AkQsbbgiZv607fe6934aefe',
            'license_plate' => '77 H1 5678',
            'id_role' => 2,
            'registration_paper' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994877-6nRQeM1cen607fe6bd6a5f5',
            'car_type'=>'Xe 3 bánh',
            'payload' => '3.6'
        ]);
    }
}
