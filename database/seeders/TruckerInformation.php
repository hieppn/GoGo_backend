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
        'id_card_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
        'id_card_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
        'license_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
        'license_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
        'license_plate' => '77 H1 5678',
        'registration_paper'=>'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
        'car_type' =>'Xe 3 bánh',
        'payload' => 3.6
        ]);
        DB::table('trucker_information')->insert([
            'id_trucker' =>5 ,
            'id_card_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'id_card_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_plate' => '77 H1 5678',
            'registration_paper'=>'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'car_type' =>'Xe 3 bánh',
            'payload' => 3.6
            ]);
        DB::table('trucker_information')->insert([
            'id_trucker' =>8 ,
            'id_card_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'id_card_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_front' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_back' => 'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'license_plate' => '77 H2 5678',
            'registration_paper'=>'https://d3i71xaburhd42.cloudfront.net/ecfbcceb44a156ac51aaf452b90c1155f4da2f44/2-Figure2-1.png',
            'car_type' =>'Xe 3 bánh',
            'payload' => 3.6
            ]);
    }
}
