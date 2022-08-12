<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Photography_servicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('photography_services')->insert([
            'user_id' => '2',
            'vendor_id'=>'3',
            'cameras'=>'4',
            'photographers' =>'3',
            'time'=>'NA',
            'price'=>'0',
            'portfolio'=>'NA',
            'professional_editing'=>'NA',
            'max_images'=>'500',
            'delivery_method'=>'NA',
            'description'=>'NA',
            'phone'=>'NA',
            'studio'=>'NA',
            'location'=>'NA',

        ]);
    }
}
