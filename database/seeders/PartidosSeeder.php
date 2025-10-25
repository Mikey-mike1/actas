<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartidosSeeder extends Seeder
{
    public function run(): void
    {
        $partidos = [
            ['nombre' => 'Partido Nacional', 'siglas' => 'PN', 'color' => '#002868'],
            ['nombre' => 'Partido Liberal', 'siglas' => 'PL', 'color' => '#D71A28'],
            ['nombre' => 'Partido Libre', 'siglas' => 'LIBRE', 'color' => '#A41E22'],
        ];

        DB::table('partidos')->insert($partidos);
    }
}
