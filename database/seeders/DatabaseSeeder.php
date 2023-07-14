<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LabelSeeder::class);
        $this->call(SegipSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(TiposDenunciaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DenunciasSeeder::class);
        $this->call(FotosDenunciaSeeder::class);
    }
}
