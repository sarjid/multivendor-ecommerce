<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title' => 'Bigshop Online Shopping',
            'meta_description' => 'Bigshop Online Shopping',
            'meta_keywords' => 'Bigshop, Online Shopping,Ecommerce Website',
            'logo' => 'frontend/img/core-img/logo.png',
            'favicon' => '',
            'address' => 'Dhaka,Bangladesh',
            'email' => 'info@gmail.com',
            'phone' => '01722260010',
            'fax' => '0082 05260 200',
            'footer' => 'Sarjid Islam',
            'facebook_url' => '',
            'twitter_url' => '',
            'linkedin_url' => '',
            'pinterest_url' => '',
        ]);
    }
}
