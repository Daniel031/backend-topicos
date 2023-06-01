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
            'tipo' => '1',
         ],
         [
            'label' => 'Trash',
            'tipo' => '1',
         ],
         [
            'label' => 'Bag',
            'tipo' => '1',
         ],
         [
            'label' => 'Plastic',
            'tipo' => '1',
         ],
         [
            'label' => 'Box',
            'tipo' => '1',
         ],
         [
            'label' => 'Landfill',
            'tipo' => '1',
         ],

         //etiquetas de alcantarillado
         [
            'label' => 'Flood',
            'tipo' => '4',
         ],
         [
            'label' => 'Water',
            'tipo' => '4',
         ],
         [
            'label' => 'Rain',
            'tipo' => '4',
         ],

         //etiquetas de areas verdes
         [
            'label' => 'Grass',
            'tipo' => '5',
         ],
         [
            'label' => 'Park Bench',
            'tipo' => '5',
         ],
         [
            'label' => 'Park',
            'tipo' => '5',
         ],
         [
            'label' => 'Vegetation',
            'tipo' => '5',
         ],
         [
            'label' => 'Plant',
            'tipo' => '5',
         ],
         [
            'label' => 'Garden',
            'tipo' => '5',
         ],
         [
            'label' => 'Outdoors',
            'tipo' => '5',
         ],
         [
            'label' => 'Herbs',
            'tipo' => '5',
         ],
         [
            'label' => 'Grove',
            'tipo' => '5',
         ],
         [
            'label' => 'Lawn',
            'tipo' => '5',
         ],
         [
            'label' => 'Outdoor Play Area',
            'tipo' => '5',
         ],
         [
            'label' => 'Grassland',
            'tipo' => '5',
         ],
         [
            'label' => 'Green',
            'tipo' => '5',
         ],
         [
            'label' => 'Tree',
            'tipo' => '5',
         ],
         [
            'label' => 'Seesaw',
            'tipo' => '5',
         ],
       ]); 
    }
}
