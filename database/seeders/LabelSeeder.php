<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('labels')->insert([
         //las etiquetas son:
         /* tipo 1 = aseo urbano
            tipo 2 = vias publicas
            tipo 3 = alumbrado publico
            tipo 4 = alcantarillado
            tipo 5 = areas verdes */

        //etiquetas de aseo urbano
         [
            'label' => 'Garbage',
            'tipo_denuncia' => '1',
         ],
         [
            'label' => 'Trash',
            'tipo_denuncia' => '1',
         ],
         [
            'label' => 'Bag',
            'tipo_denuncia' => '1',
         ],
         [
            'label' => 'Plastic',
            'tipo_denuncia' => '1',
         ],
         [
            'label' => 'Box',
            'tipo_denuncia' => '1',
         ],
         [
            'label' => 'Landfill',
            'tipo_denuncia' => '1',
         ],

         //etiquetas de vias publicas
         [
            'label' => 'Water',
            'tipo_denuncia' => '2',
         ],
         [
            'label' => 'Puddle',
            'tipo_denuncia' => '2',
         ],
         [
            'label' => 'Tar',
            'tipo_denuncia' => '2',
         ],
         [
            'label' => 'Tarmac',
            'tipo_denuncia' => '2',
         ],
         [
            'label' => 'Road',
            'tipo_denuncia' => '2',
         ],
         [
            'label' => 'Soil',
            'tipo_denuncia' => '2',
         ],
         [
            'label' => 'Street',
            'tipo_denuncia' => '2',
         ],
         [
            'label' => 'Urban',
            'tipo_denuncia' => '2',
         ],

         //etiquetas de vias alumbrado publico
         [
            'label' => 'Lighting',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Street',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'City',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Light',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Tarmac',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Freeway',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Lamp',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Lamp Post',
            'tipo_denuncia' => '3',
         ],

         [
            'label' => 'Lampshade',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Outdoors',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Urban',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Night',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Alley',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Neighborhood',
            'tipo_denuncia' => '3',
         ],
         [
            'label' => 'Utility Pole',
            'tipo_denuncia' => '3',
         ],
         
         //etiquetas de alcantarillado
         [
            'label' => 'Flood',
            'tipo_denuncia' => '4',
         ],
         [
            'label' => 'Water',
            'tipo_denuncia' => '4',
         ],
         [
            'label' => 'Rain',
            'tipo_denuncia' => '4',
         ],

         //etiquetas de areas verdes
         [
            'label' => 'Grass',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Park Bench',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Park',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Vegetation',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Plant',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Garden',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Outdoors',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Herbs',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Grove',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Lawn',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Outdoor Play Area',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Grassland',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Green',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Tree',
            'tipo_denuncia' => '5',
         ],
         [
            'label' => 'Seesaw',
            'tipo_denuncia' => '5',
         ],
       ]); 
    }
}
