<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->insert([
            [
                'nombre' => 'parques y jardines',
                'descripcion' => 'unidad municipal encargada de mantener areas verdes'
            ],
            [
                'nombre' => 'unidad decentralizada de electrificacion',
                'descripcion' => 'unidad municipal encargada de mantener la iluminacion publica'
            ],
            [
                'nombre' => 'alcantarillado y saneamiento basico',
                'descripcion' => 'unidad municipal encargada de mantener el alcantarillado publico'
            ],
            [
                'nombre' => 'Complejo Municipal de Tratamiento de Residuos Sólidos',
                'descripcion' => 'unidad municipal encargada de mantener el aseo urbano'
            ],
            [
                'nombre' => 'Secretaría Municipal de Obras Públicas',
                'descripcion' => 'unidad municipal encargada de mantener el estado de las calles y avenidas'
            ],
        ]);
    }
}
