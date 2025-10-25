<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resultado;
use App\Models\Candidato;
use App\Models\Municipio;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener todos los resultados con relaciones necesarias
        $resultados = Resultado::with('candidato.partido', 'acta.municipio')->get();
        $candidatos = Candidato::all();
        $municipios = Municipio::all();

        // Votos totales por candidato
        $votosCandidatos = $resultados->groupBy('candidato_id')->map(fn($r) => $r->sum('votos'))->sortDesc();
        $top10 = $votosCandidatos->take(10);
        $candidatosTop = Candidato::whereIn('id', $top10->keys())->get();

        // Votos por municipio usando el ID
        $municipiosVotos = [];
        foreach ($municipios as $municipio) {
            // Filtrar resultados por municipio
            $votos = $resultados->filter(fn($r) => $r->acta && $r->acta->municipio_id == $municipio->id)
                                ->groupBy('candidato_id')
                                ->map(fn($r) => $r->sum('votos'));

            // Asegurar que todos los candidatos estén presentes
            $votosCompleto = [];
            foreach ($candidatos as $candidato) {
                $votosCompleto[$candidato->nombre] = $votos->get($candidato->id) ?? 0;
            }

            // Guardar con el ID real del municipio
            $municipiosVotos[$municipio->id] = $votosCompleto;
        }

        // Pasar todo a la vista
        return view('dashboard', compact('resultados', 'candidatos', 'municipios', 'candidatosTop', 'top10', 'municipiosVotos'));
    }
}
