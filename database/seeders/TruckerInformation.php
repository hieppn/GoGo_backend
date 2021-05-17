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
        'id_trucker' =>4 ,
        'id_card_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618993610-Ya6QMTH4UL607fe1ca59fd8',
        'id_card_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994660-FtNzAahtNU607fe5e429659',
        'license_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994744-Fl8YT1cAhy607fe6381dffc',
        'license_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994835-AkQsbbgiZv607fe6934aefe',
        'license_plate' => '77 H1 5678',
        'registration_paper'=>'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994877-6nRQeM1cen607fe6bd6a5f5',
        'car_type' =>'Xe 3 bánh',
        'payload' => 3.6
        ]);
        DB::table('trucker_information')->insert([
            'id_trucker' =>5 ,
            'id_card_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618993610-Ya6QMTH4UL607fe1ca59fd8',
            'id_card_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994660-FtNzAahtNU607fe5e429659',
            'license_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994744-Fl8YT1cAhy607fe6381dffc',
            'license_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994835-AkQsbbgiZv607fe6934aefe',
            'license_plate' => '77 H1 5678',
            'registration_paper'=>'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994877-6nRQeM1cen607fe6bd6a5f5',
            'car_type' =>'Xe 3 bánh',
            'payload' => 3.6
            ]);
        DB::table('trucker_information')->insert([
            'id_trucker' =>8 ,
            'id_card_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618993610-Ya6QMTH4UL607fe1ca59fd8',
            'id_card_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994660-FtNzAahtNU607fe5e429659',
            'license_front' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994744-Fl8YT1cAhy607fe6381dffc',
            'license_back' => 'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994835-AkQsbbgiZv607fe6934aefe',
            'license_plate' => '77 H2 5678',
            'registration_paper'=>'https://dev-dtravel-data.s3.ap-northeast-1.amazonaws.com/images/1618994877-6nRQeM1cen607fe6bd6a5f5',
            'car_type' =>'Xe 3 bánh',
            'payload' => 3.6
            ]);
    }
}
