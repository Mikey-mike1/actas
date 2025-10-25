<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    public function run(): void
    {
        $municipios = [
            ['codigo' => '01', 'nombre' => 'Distrito Central'],
            ['codigo' => '02', 'nombre' => 'Alubarén'],
            ['codigo' => '03', 'nombre' => 'Cedros'],
            ['codigo' => '04', 'nombre' => 'Curarén'],
            ['codigo' => '05', 'nombre' => 'El Porvenir'],
            ['codigo' => '06', 'nombre' => 'Guaimaca'],
            ['codigo' => '07', 'nombre' => 'La Libertad'],
            ['codigo' => '08', 'nombre' => 'La Venta'],
            ['codigo' => '09', 'nombre' => 'Lepaterique'],
            ['codigo' => '10', 'nombre' => 'Maraita'],
            ['codigo' => '11', 'nombre' => 'Marale'],
            ['codigo' => '12', 'nombre' => 'Nueva Armenia'],
            ['codigo' => '13', 'nombre' => 'Ojojona'],
            ['codigo' => '14', 'nombre' => 'Orica'],
            ['codigo' => '15', 'nombre' => 'Reitoca'],
            ['codigo' => '16', 'nombre' => 'Sabanagrande'],
            ['codigo' => '17', 'nombre' => 'San Antonio de Oriente'],
            ['codigo' => '18', 'nombre' => 'San Buenaventura'],
            ['codigo' => '19', 'nombre' => 'San Ignacio'],
            ['codigo' => '20', 'nombre' => 'Cantarranas'],
            ['codigo' => '21', 'nombre' => 'San Miguelito'],
            ['codigo' => '22', 'nombre' => 'Santa Ana'],
            ['codigo' => '23', 'nombre' => 'Santa Lucía'],
            ['codigo' => '24', 'nombre' => 'Talanga'],
            ['codigo' => '25', 'nombre' => 'Tatumbla'],
            ['codigo' => '26', 'nombre' => 'Valle de Ángeles'],
            ['codigo' => '27', 'nombre' => 'Villa de San Francisco'],
            ['codigo' => '28', 'nombre' => 'Vallecillos'],
        ];

        DB::table('municipios')->insert($municipios);
    }
}
