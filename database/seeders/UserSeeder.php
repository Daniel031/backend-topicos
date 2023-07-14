<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Daniel Maldonado',
                'email' => 'Daniel@gmail.com',
                'password' => bcrypt('111'),
                'area_id' => '1'
                
            ],
            [
                'name' => 'Dilker Cartagena',
                'email' => 'dilker72@gmail.com',
                'password' => bcrypt('123456789'),
                'area_id' => '2'
            ],
            [
                'name' => 'Jose Padilla',
                'email' => 'Jose@gmail.com',
                'password' => bcrypt('333'),
                'area_id' => '3'
            ],
          ]);
    }
}
