<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Municipio;
use App\Models\CentroVotacion;
use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActaController extends Controller
{
    // Mostrar formulario para crear acta
    public function create()
    {
        $municipios = Municipio::all();
        $candidatos = Candidato::with('partido')->get();

        return view('actas.create', compact('municipios', 'candidatos'));
    }

    // Guardar acta en la base de datos y subir PDF a S3
    public function store(Request $request)
    {
        $request->validate([
            'municipio_id' => 'required|exists:municipios,id',
            'centro_votacion_id' => 'required|exists:centro_votacions,id',
            'jrv' => 'required|string|max:255',
            'votos' => 'required|array',
            'pdf_path' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $pdfUrl = null;

        if ($request->hasFile('pdf_path')) {
            $file = $request->file('pdf_path');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Subir archivo a S3 con visibilidad pública
            $pdfPath = Storage::disk('s3')->putFileAs('actas', $file, $filename, 'public');

            if ($pdfPath) {
                $pdfUrl = Storage::disk('s3')->url($pdfPath);
            }
        }

        // Crear el acta
        $acta = Acta::create([
            'municipio_id' => $request->municipio_id,
            'centro_votacion_id' => $request->centro_votacion_id,
            'jrv' => $request->jrv,
            'observaciones' => $request->observaciones,
            'pdf_path' => $pdfUrl,
        ]);

        // Registrar los resultados por candidato
        foreach ($request->votos as $candidato_id => $votos) {
            $acta->resultados()->create([
                'candidato_id' => $candidato_id,
                'votos' => $votos ?? 0,
            ]);
        }

        return redirect()->back()->with('success', '✅ Acta registrada correctamente.');
    }

    // API para obtener centros de votación según municipio
    public function getCentros($municipio_id)
    {
        $centros = CentroVotacion::where('municipio_id', $municipio_id)->get(['id', 'nombre']);
        return response()->json($centros);
    }

    // Listar actas con opción de filtros
    public function listarActas(Request $request)
    {
        $query = Acta::with(['municipio', 'centro']);

        if ($request->municipio_id) {
            $query->where('municipio_id', $request->municipio_id);
        }

        if ($request->centro_votacion_id) {
            $query->where('centro_votacion_id', $request->centro_votacion_id);
        }

        $actas = $query->orderBy('created_at', 'desc')->get();
        $municipios = Municipio::all();
        $centros = CentroVotacion::all();

        return view('actas.listar-actas', compact('actas', 'municipios', 'centros'));
    }

    // Mostrar detalles de un acta
    public function show($id)
    {
        $acta = Acta::with(['municipio', 'centro', 'resultados.candidato.partido'])->findOrFail($id);
        return view('actas.show', compact('acta'));
    }

    // Mostrar formulario para editar acta
    public function edit($id)
    {
        $acta = Acta::with('resultados.candidato')->findOrFail($id);
        $municipios = Municipio::all();
        $centros = CentroVotacion::where('municipio_id', $acta->municipio_id)->get();
        $candidatos = Candidato::with('partido')->get();

        return view('actas.edit', compact('acta', 'municipios', 'centros', 'candidatos'));
    }

    // Actualizar acta en la base de datos
    public function update(Request $request, $id)
    {
        if (!in_array(Auth::user()->rol, ['admin', 'supervisor', 'digitador'])) {
            abort(403, 'No tienes permiso para editar esta acta.');
        }

        $acta = Acta::with('resultados')->findOrFail($id);

        $request->validate([
            'votos' => 'required|array',
            'votos.*' => 'integer|min:0'
        ]);

        foreach ($request->votos as $resultado_id => $cantidad) {
            $resultado = $acta->resultados()->find($resultado_id);
            if ($resultado) {
                $resultado->update(['votos' => $cantidad]);
            }
        }

        return redirect()->route('actas.listar')->with('success', 'Acta actualizada correctamente.');
    }

    // Eliminar acta
    public function destroy($id)
    {
        $acta = Acta::findOrFail($id);

        // Validar permisos (solo admin o supervisor)
        if (!in_array(Auth::user()->rol, ['admin', 'supervisor'])) {
            abort(403, 'No tienes permiso para eliminar esta acta.');
        }

        // Eliminar PDF de S3 si existe
        if ($acta->pdf_path) {
            $relativePath = parse_url($acta->pdf_path, PHP_URL_PATH);
            Storage::disk('s3')->delete(ltrim($relativePath, '/'));
        }

        // Eliminar resultados relacionados
        $acta->resultados()->delete();

        // Eliminar el acta
        $acta->delete();

        return redirect()->route('actas.listar')->with('success', '🗑️ Acta eliminada correctamente.');
    }
}
