@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="center-align">Editar Votos - Acta #{{ $acta->jrv }}</h4>

    <div class="card">
        <div class="card-content">
            <span class="card-title">Información del Acta</span>
            <div class="row">
                <div class="col s6">
                    <strong>JRV:</strong> {{ $acta->jrv }}<br>
                    <strong>Municipio:</strong> {{ $acta->municipio->nombre ?? '-' }}<br>
                    <strong>Centro de Votación:</strong> {{ $acta->centro->nombre ?? '-' }}
                </div>
                <div class="col s6">
                    <strong>Observaciones:</strong> {{ $acta->observaciones ?? 'Ninguna' }}<br>
                    <strong>PDF:</strong>
                    @if($acta->pdf_path)
                        <a href="{{ Storage::url($acta->pdf_path) }}" target="_blank" class="btn-small blue">Ver PDF</a>
                    @else
                        Ninguno
                    @endif
                    <br>
                    <strong>Creado:</strong> {{ $acta->created_at }}<br>
                    <strong>Última actualización:</strong> {{ $acta->updated_at }}
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('actas.update', $acta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-content">
                <span class="card-title">Votos por Candidato</span>
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Candidato</th>
                            <th>Partido</th>
                            <th>Votos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($acta->resultados as $resultado)
                        <tr>
                            <td>{{ $resultado->candidato->nombre }}</td>
                            <td>{{ $resultado->candidato->partido->nombre ?? '-' }}</td>
                            <td>
                                <input type="number" name="votos[{{ $resultado->id }}]" value="{{ $resultado->votos }}" min="0" required>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col s12 m6">
                <button type="submit" class="btn green waves-effect waves-light">
                    Guardar Cambios
                </button>
            </div>
            <div class="col s12 m6">
                <a href="{{ route('actas.listar') }}" class="btn grey waves-effect waves-light">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
