<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            
            'send_from'=>'Quang Nam',
            'send_to'=>'Da Nang',
            'time_send'=>'2020-07-06 18:20:40',
            'name'=> " Chuyen nha tro bao gom cac do dung",
            'mass'=>100,
            'car_type'=>'xe tair 4 banh',
            'export_data'=>true,
            'image'=>'ord1.png',
            'type'=>'new',
            'price'=>'12000000',
            'sender_info'=>'Huong 101',
            'receiver_info'=>'Huong 102',
            'id_user'=>1,
            
        ]);

        DB::table('orders')->insert([
            
            'send_from'=>'Quang Nam',
            'send_to'=>'Da Nang',
            'time_send'=>'2020-07-06 18:20:40',
            'name'=> " Chuyen nha tro bao gom cac do dung",
            'mass'=>100,
            'car_type'=>'xe tair 4 banh',
            'export_data'=>true,
            'image'=>'ord1.png',
            'type'=>'new',
            'price'=>'12000000',
            'sender_info'=>'Huong 101',
            'receiver_info'=>'Huong 102',
            'id_user'=>2,
        ]);
    }
}
