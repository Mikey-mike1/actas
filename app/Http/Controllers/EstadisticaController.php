<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta;
use App\Models\Municipio;
use App\Models\CentroVotacion;

class EstadisticaController extends Controller
{
  public function index(Request $request)
{
    $municipios = Municipio::all();
    $municipio_id = $request->municipio_id;
    $centro_id = $request->centro_votacion_id;
    $jrv = $request->jrv;
    $candidato_id = $request->candidato_id; // nuevo filtro para la sección por candidato

    // --- Estadísticas generales por candidato ---
    $actasQuery = Acta::with(['resultados.candidato', 'municipio', 'centro']);
    if ($municipio_id) $actasQuery->where('municipio_id', $municipio_id);
    if ($centro_id) $actasQuery->where('centro_votacion_id', $centro_id);
    if ($jrv) $actasQuery->where('jrv', $jrv);
    $actas = $actasQuery->get();

    $candidatosVotos = [];
    foreach ($actas as $acta) {
        foreach ($acta->resultados as $resultado) {
            $key = $resultado->candidato->id;
            if (!isset($candidatosVotos[$key])) {
                $candidatosVotos[$key] = [
                    'numero' => $resultado->candidato->numero,
                    'nombre' => $resultado->candidato->nombre,
                    'municipio' => $acta->municipio->nombre,
                    'centro' => $acta->centro->nombre,
                    'jrv' => $acta->jrv,
                    'votos' => 0,
                ];
            }
            $candidatosVotos[$key]['votos'] += $resultado->votos;
        }
    }
    $datosTabla = collect($candidatosVotos)->sortByDesc('votos')->values()->toArray();

    // --- Sección votos por candidato en centros ---
    $candidatos = \App\Models\Candidato::orderBy('numero')->get();
    $datosCandidato = [];
    if ($candidato_id) {
        $resultados = \App\Models\Resultado::with(['acta.centro', 'acta.municipio'])
            ->where('candidato_id', $candidato_id)
            ->get();

        $agrupados = [];
        foreach ($resultados as $res) {
            $centroId = $res->acta->centro->id;
            if (!isset($agrupados[$centroId])) {
                $agrupados[$centroId] = [
                    'centro' => $res->acta->centro->nombre,
                    'municipio' => $res->acta->municipio->nombre,
                    'votos' => 0,
                ];
            }
            $agrupados[$centroId]['votos'] += $res->votos;
        }
        $datosCandidato = collect($agrupados)->sortByDesc('votos')->values()->toArray();
    }

    // Centros dinámicos si se selecciona municipio
    $centrosList = $municipio_id ? CentroVotacion::where('municipio_id', $municipio_id)->get() : null;

    // JRVs dinámicas si se selecciona centro
    $jrvsList = ($municipio_id && $centro_id)
        ? Acta::where('municipio_id', $municipio_id)
               ->where('centro_votacion_id', $centro_id)
               ->pluck('jrv')->unique()
        : null;

    return view('actas.estadisticas', compact(
        'municipios',
        'datosTabla',
        'municipio_id',
        'centro_id',
        'jrv',
        'centrosList',
        'jrvsList',
        'candidatos',
        'candidato_id',
        'datosCandidato'
    ));
}

}
