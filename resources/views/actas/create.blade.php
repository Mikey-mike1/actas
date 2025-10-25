@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="center-align">Registro de Acta Electoral</h4>

    @if(session('success'))
        <div class="card-panel green lighten-4 green-text text-darken-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('actas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="input-field col s6">
                <select name="municipio_id" id="municipio" required>
                    <option value="" disabled selected>Seleccione un municipio</option>
                    @foreach($municipios as $m)
                        <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                    @endforeach
                </select>
                <label>Municipio</label>
            </div>

            <div class="input-field col s6">
                <select name="centro_votacion_id" id="centro" required>
                    <option value="" disabled selected>Seleccione un municipio primero</option>
                </select>
                <label>Centro de Votación</label>
            </div>
        </div>

        <div class="input-field">
            <input type="text" name="jrv" id="jrv" required>
            <label for="jrv">Número de JRV</label>
        </div>

        <h5 class="center-align">Resultados por Partido</h5>

        <div class="card-panel">
            <table class="highlight centered responsive-table">
                <thead>
                    <tr>
                        <th style="width: 150px;">Partido</th>
                        <th style="width: 200px;">Candidato</th>
                        <th style="width: 120px;">Votos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidatos->groupBy('partido.nombre') as $partido => $grupo)
                        @foreach($grupo as $candidato)
                            <tr>
                                {{-- Mostrar el nombre del partido una sola vez por grupo --}}
                                @if($loop->first)
                                    <td rowspan="{{ $grupo->count() }}" class="blue-text text-darken-2" style="vertical-align: middle;">
                                        <strong>{{ $partido }}</strong>
                                    </td>
                                @endif

                                {{-- Candidato con número y nombre --}}
                                <td>
                                    <div style="font-size: 1.4rem; font-weight: bold;">{{ $candidato->numero ?? $candidato->id }}</div>
                                    <div style="font-size: 13px;">{{ $candidato->nombre }}</div>
                                </td>

                                {{-- Campo para votos --}}
                                <td>
                                    <input 
                                        type="number" 
                                        name="votos[{{ $candidato->id }}]" 
                                        min="0" 
                                        value="0" 
                                        class="center-align browser-default" 
                                        style="width: 100px; text-align: center;">
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="file-field input-field">
            <div class="btn blue darken-2">
                <span>Subir PDF</span>
                <input type="file" name="pdf_path" accept="application/pdf">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Seleccione el archivo del acta (opcional)">
            </div>
        </div>

        <div class="input-field">
            <textarea name="observaciones" id="observaciones" class="materialize-textarea"></textarea>
            <label for="observaciones">Observaciones</label>
        </div>

        <div class="center-align">
            <button type="submit" class="btn blue darken-3 waves-effect waves-light">Guardar Acta</button>
        </div>
    </form>
</div>

{{-- jQuery + Materialize --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    M.FormSelect.init(document.querySelectorAll('select'));
});

// Cargar centros dinámicamente
$('#municipio').on('change', function() {
    var municipioId = $(this).val();
    var centroSelect = $('#centro');

    centroSelect.empty().append('<option disabled selected>Cargando...</option>');
    M.FormSelect.init(centroSelect);

    if (municipioId) {
        $.get('/api/centros/' + municipioId, function(data) {
            centroSelect.empty().append('<option disabled selected>Seleccione...</option>');
            $.each(data, function(i, centro) {
                centroSelect.append('<option value="' + centro.id + '">' + centro.nombre + '</option>');
            });
            M.FormSelect.init(centroSelect);
        });
    } else {
        centroSelect.html('<option disabled selected>Seleccione un municipio primero</option>');
        M.FormSelect.init(centroSelect);
    }
});
</script>
@endsection
