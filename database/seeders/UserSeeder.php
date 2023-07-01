<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'admin',
            'role' => 'admin',
            'status' => '1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'created_at' =>\Date::now(),
        ]);

        \DB::table('users')->insert([
            'name' => 'test',
            'role' => '',
            'status' => '1',
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
            'created_at' =>\Date::now(),
        ]);
    }
}
