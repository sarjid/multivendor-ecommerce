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
            //admin
            [
                'full_name' => 'Sarjid Islam',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '01722260010',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //seller
            [
                'full_name' => 'Gaget Planet seller',
                'username' => 'seller',
                'email' => 'seller@gmail.com',
                'phone' => '01766620010',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'status' => 'active',
            ],
            //customers
            [
                'full_name' => 'New Customer',
                'username' => 'Customer',
                'email' => 'customer@gmail.com',
                'phone' => '01318090002',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'status' => 'active',
            ]
        ]);
    }
}
