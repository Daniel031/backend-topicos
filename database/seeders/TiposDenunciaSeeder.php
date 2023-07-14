<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDenunciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_denuncia')->insert([
            [
                'nombre' => 'areas verdes', 
                'descripcion' => 'denuncias referidas sobre el descuido de las areas verdes publicas como parques y plazuelas', 
                'area_id' => '1',
            ],
            [
                'nombre' => 'aseo urbano', 
                'descripcion' => 'denuncias referidas sobre el descuido de recojo de la basura', 
                'area_id' => '4',
            ],
            [
                'nombre' => 'alcantarillado', 
                'descripcion' => 'denuncias referidas sobre avenidas y calles inundadas', 
                'area_id' => '3',
            ],
            [
                'nombre' => 'vias publicas', 
                'descripcion' => 'denuncias referidas sobre baches en calles avenidas y carreteras',
                'area_id' => '5',
            ],
            [
                'nombre' => 'alumbrado publico', 
                'descripcion' => 'denuncias referidas sobre calles avenidas plazas y parques sin iluminacion', 
                'area_id' => '2',
            ],
        ]);
    }
}



