<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vendors')->insert([
            'name' => 'Momtahina Rahman',
            'user_id' => '2',
            'category' => '1',
            'email' => 'mr@g.com',
            'phone' => '01730292930',
            'response' =>'0',
            'review' =>'0',
            'ratings'=> '0',
            'address'=> '27 Chamelibag',
            'areas' =>'Shantinagar',
            'licence'=>'NA',
            'about'=>'NA',
            'logo'=>'NA',
            'fb' =>'ABC',
            'insta'=>'ABC',
            'whatsapp'=>'ABC',
            'linkedin'=>'ABC',
            'youtube'=>'ABC',
            'established'=>'2019',
        ]);
    }
}
