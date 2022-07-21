<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Momtahina Rahman',
            'email' => 'mr@g.com',
            'password' => Hash::make('zzzzzzz'),
            'dob' => '2000-09-13',
            'location' => 'Dhaka',
            'phone' => '01730292930',
            'nid' => '200'
        ]);
    }
}
