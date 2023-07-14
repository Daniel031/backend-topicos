<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
class SegipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('segip')->insert([
        [
            'ci' => '111',
            'nombre' => 'Daniel',
            'apellidos' => 'Maldonado',
            'fecha_nacimiento' => Carbon::now(),
            'foto' => 'https://res.cloudinary.com/dirau81x6/image/upload/v1685575849/clu38hxfvt7aehf6q5sm.jpg',
            'sexo' => '1',
        ],
        [
            'ci' => '222',
            'nombre' => 'Dilker',
            'apellidos' => 'Cartagena',
            'fecha_nacimiento' => Carbon::now(),
            'foto' => 'https://res.cloudinary.com/dirau81x6/image/upload/v1689191819/ivghfkaufy0y77wcxhoi.jpg',
            'sexo' => '1',
        ],
        [
            'ci' => '333',
            'nombre' => 'Jose',
            'apellidos' => 'Padilla',
            'fecha_nacimiento' => Carbon::now(),
            'foto' => 'https://res.cloudinary.com/dirau81x6/image/upload/v1689202169/WhatsApp_Image_2023-07-12_at_18.47.47_jkkzi5.jpg',
            'sexo' => '1',
        ],
        [
            'ci' => '444',
            'nombre' => 'Miguel Jesus',
            'apellidos' => 'Peinado Pereira',
            'fecha_nacimiento' => Carbon::now(),
            'foto' => 'https://res.cloudinary.com/dirau81x6/image/upload/v1689201985/WhatsApp_Image_2023-07-12_at_18.45.23_khz1u5.jpg',
            'sexo' => '1',
        ],

    ]);
    }
}
