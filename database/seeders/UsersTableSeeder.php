<?php

namespace Database\Seeders;

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
            [
                'full_name' => 'New Customer',
                'username' => 'Customer',
                'email' => 'customer@gmail.com',
                'phone' => '01722260010',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        ]);

        DB::table('admins')->insert([
            [
                'full_name' => 'Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '01722260011',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        ]);

        DB::table('sellers')->insert([
            [
                'full_name' => 'Mr. Seller',
                'username' => 'Mr. Seller',
                'email' => 'seller@gmail.com',
                'address' => 'Dhaka,Bangladesh',
                'phone' => '01722260012',
                'photo' => '',
                'password' => Hash::make('password'),
                'is_verified' => 0,
                'status' => 'active',
            ]
        ]);
    }
}
