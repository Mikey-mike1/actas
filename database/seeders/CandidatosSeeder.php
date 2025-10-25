<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidatosSeeder extends Seeder
{
    public function run(): void
    {
        $candidatos = [
            // NACIONAL
            ['partido_id' => 1, 'nombre' => 'nevitt zabdiel josue berríos de erreirós', 'numero' => 93],
            ['partido_id' => 1, 'nombre' => 'lissi marcella matute cano', 'numero' => 94],
            ['partido_id' => 1, 'nombre' => 'andreo daniel burgos bobadilla', 'numero' => 95],
            ['partido_id' => 1, 'nombre' => 'sara elizabeth estrada zavala', 'numero' => 96],
            ['partido_id' => 1, 'nombre' => 'antonio césar reyes callejas', 'numero' => 97],
            ['partido_id' => 1, 'nombre' => 'joshua gutiérrez lacayo', 'numero' => 98],
            ['partido_id' => 1, 'nombre' => 'shatya sharim morales valverde', 'numero' => 99],
            ['partido_id' => 1, 'nombre' => 'maría josé sosa frobelis', 'numero' => 100],
            ['partido_id' => 1, 'nombre' => 'naurely sarah guerra miralda', 'numero' => 101],
            ['partido_id' => 1, 'nombre' => 'conrado josé ramos aguilar', 'numero' => 102],
            ['partido_id' => 1, 'nombre' => 'lenny daniel cruz perdomo', 'numero' => 103],
            ['partido_id' => 1, 'nombre' => 'adolfo raquel friden', 'numero' => 104],
            ['partido_id' => 1, 'nombre' => 'fabiola lucila rosa vigil', 'numero' => 105],
            ['partido_id' => 1, 'nombre' => 'varesi abraham manuel cruzamo', 'numero' => 106],
            ['partido_id' => 1, 'nombre' => 'mercedes elisabeth torres mejía', 'numero' => 107],
            ['partido_id' => 1, 'nombre' => 'kevin dania sandoval ponilla', 'numero' => 108],
            ['partido_id' => 1, 'nombre' => 'vanessa jacqueline zelaya sánchez', 'numero' => 109],
            ['partido_id' => 1, 'nombre' => 'josé luis arévalo villafrán', 'numero' => 110],
            ['partido_id' => 1, 'nombre' => 'oscar salomón paniagua rodríguez', 'numero' => 111],
            ['partido_id' => 1, 'nombre' => 'lourdes janeth medina', 'numero' => 112],
            ['partido_id' => 1, 'nombre' => 'katerin jazmin salgado quiroz', 'numero' => 113],
            ['partido_id' => 1, 'nombre' => 'graciela maribela sierra cruz', 'numero' => 114],
            ['partido_id' => 1, 'nombre' => 'alberto antonio muñoz flores', 'numero' => 115],

            // LIBERAL
            ['partido_id' => 2, 'nombre' => 'iroshka lindaly elvir', 'numero' => 70],
            ['partido_id' => 2, 'nombre' => 'srai pamela espinal', 'numero' => 71],
            ['partido_id' => 2, 'nombre' => 'edgardo rashid mejia', 'numero' => 72],
            ['partido_id' => 2, 'nombre' => 'jose solomon nazar', 'numero' => 73],
            ['partido_id' => 2, 'nombre' => 'jhosy toscano ramirez', 'numero' => 74],
            ['partido_id' => 2, 'nombre' => 'alia niño kafaty', 'numero' => 75],
            ['partido_id' => 2, 'nombre' => 'rafael canales girbal', 'numero' => 76],
            ['partido_id' => 2, 'nombre' => 'milagros de jesus gonsalez', 'numero' => 77],
            ['partido_id' => 2, 'nombre' => 'karla lizeth romero davila', 'numero' => 78],
            ['partido_id' => 2, 'nombre' => 'sandra maribel flores', 'numero' => 79],
            ['partido_id' => 2, 'nombre' => 'besayda sarahi vasquez rodriguez', 'numero' => 80],
            ['partido_id' => 2, 'nombre' => 'luz ernestina mejia portillo', 'numero' => 81],
            ['partido_id' => 2, 'nombre' => 'maximo german lobo munguia', 'numero' => 82],
            ['partido_id' => 2, 'nombre' => 'katherine alejandra hernandez', 'numero' => 83],
            ['partido_id' => 2, 'nombre' => 'manuel enrique andino', 'numero' => 84],
            ['partido_id' => 2, 'nombre' => 'lesly yaquelin lopez', 'numero' => 85],
            ['partido_id' => 2, 'nombre' => 'bernardo benjamin anarbia', 'numero' => 86],
            ['partido_id' => 2, 'nombre' => 'luis fernando reyes', 'numero' => 87],
            ['partido_id' => 2, 'nombre' => 'yadira waleska calix', 'numero' => 88],
            ['partido_id' => 2, 'nombre' => 'martha patricia hernandez', 'numero' => 89],
            ['partido_id' => 2, 'nombre' => 'salvador videsmundo cabrera', 'numero' => 90],
            ['partido_id' => 2, 'nombre' => 'wilfredo garcia godoy', 'numero' => 91],
            ['partido_id' => 2, 'nombre' => 'raul alexis chacon', 'numero' => 92],

            // LIBRE
            ['partido_id' => 3, 'nombre' => 'hugo noe pino', 'numero' => 24],
            ['partido_id' => 3, 'nombre' => 'gustavo gonsalez maldonado', 'numero' => 25],
            ['partido_id' => 3, 'nombre' => 'clara lopez perez', 'numero' => 26],
            ['partido_id' => 3, 'nombre' => 'carlos reina garcia', 'numero' => 27],
            ['partido_id' => 3, 'nombre' => 'kritza jerlin perez', 'numero' => 28],
            ['partido_id' => 3, 'nombre' => 'carmen lopez flores', 'numero' => 29],
            ['partido_id' => 3, 'nombre' => 'marco giron portillo', 'numero' => 30],
            ['partido_id' => 3, 'nombre' => 'mohsen yamir ramos', 'numero' => 31],
            ['partido_id' => 3, 'nombre' => 'juan barahona mejia', 'numero' => 32],
            ['partido_id' => 3, 'nombre' => 'jari herrera hernandez', 'numero' => 33],
            ['partido_id' => 3, 'nombre' => 'lucy michell guerrero', 'numero' => 34],
            ['partido_id' => 3, 'nombre' => 'suyapa andino flores', 'numero' => 35],
            ['partido_id' => 3, 'nombre' => 'rocio walkira santos', 'numero' => 36],
            ['partido_id' => 3, 'nombre' => 'mario orlando suazo', 'numero' => 37],
            ['partido_id' => 3, 'nombre' => 'andres alfredo castro turcios', 'numero' => 38],
            ['partido_id' => 3, 'nombre' => 'jose manuel rodrigez rosales', 'numero' => 39],
            ['partido_id' => 3, 'nombre' => 'german rene villalobo', 'numero' => 40],
            ['partido_id' => 3, 'nombre' => 'german omar ortiz', 'numero' => 41],
            ['partido_id' => 3, 'nombre' => 'diego javier sanchez cueva', 'numero' => 42],
            ['partido_id' => 3, 'nombre' => 'miriam janeth osorto', 'numero' => 43],
            ['partido_id' => 3, 'nombre' => 'beverlu hazel alegria', 'numero' => 44],
            ['partido_id' => 3, 'nombre' => 'maritza yamilet gonsalez', 'numero' => 45],
            ['partido_id' => 3, 'nombre' => 'reyna samanta casildo', 'numero' => 46],
        ];

        DB::table('candidatos')->insert($candidatos);
    }
}
