<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('services')->insert([
            'name' => 'Decoration',
            'user_id' => '2',
            'vendor_id'=>'3',
            'description'=>'NA',
            'price' =>'0',
            'inform'=>'NA',
            'build'=>'NA',
            'placement'=>'0',
            'space'=>'NA',
            'guest'=>'0',
            'colors'=>'NA',
            'customization'=>'0',
            'location'=>'Dhaka',
        ]);
    }
}
