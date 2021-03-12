<?php

namespace Database\Seeders;

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
            'unit'=>'3 bao',
            'car_type'=>'xe tair 4 banh',
            'note'=>'mot so do de vow hay can than',
            'image'=>'ord1.png',
            'type'=>'chua',
            'id_user'=>1,
            
        ]);


        DB::table('orders')->insert([
            
            'send_from'=>'Quang Ngai',
            'send_to'=>'Quang NAm',
            'time_send'=>'2020-05-06 18:20:40',
            'name'=> " Chuyen nha tro bao gom cac do dung",
            'mass'=>200,
            'unit'=>'10 bao',
            'car_type'=>'xe tair 4 banh',
            'note'=>'mot so do quan trong hay can than',
            'image'=>'ord2.png',
            'type'=>'chua',
            'id_user'=>2,
        ]);
    }
}
