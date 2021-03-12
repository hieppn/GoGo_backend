<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('Promotions')->insert([
            
            'name'=>'Chuong trinh khuyen maix ddawcj bietj',
            'code'=>'GOGO',
            'start_time'=>"2020-12-1 1:1:1",
            'end_time'=> "2021-1-1 18:50:00",
            'min_value'=>100,
            'max_value'=>200,
            'value'=>'60',
        ]);

        DB::table('Promotions')->insert([
            
            'name'=>'Chuong trinh khuyen maix ',
            'code'=>'HUhu',
            'start_time'=>"2021-1-1 12:11:11",
            'end_time'=>"2021-2-1 18:50:00",
            'min_value'=>150,
            'max_value'=>200,
            'value'=>'80',
        ]);




    }
}
