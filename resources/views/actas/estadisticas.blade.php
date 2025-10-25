@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="center-align">📊 Estadísticas Electorales por Candidato</h4>

    <!-- Filtros jerárquicos -->
    <div class="row">
        <form action="{{ route('estadisticas.index') }}" method="GET">
            <div class="input-field col s4">
                <select name="municipio_id" id="municipio">
                    <option value="" selected>Todos los Municipios</option>
                    @foreach($municipios as $m)
                        <option value="{{ $m->id }}" {{ request('municipio_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->nombre }}
                        </option>
                    @endforeach
                </select>
                <label>Municipio</label>
            </div>

            @if(request('municipio_id'))
            <div class="input-field col s4">
                <select name="centro_votacion_id" id="centro">
                    <option value="" selected>Todos los Centros</option>
                    @if($centrosList)
                        @foreach($centrosList as $c)
                            <option value="{{ $c->id }}" {{ request('centro_votacion_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->nombre }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <label>Centro de Votación</label>
            </div>
            @endif

            @if(request('centro_votacion_id'))
            <div class="input-field col s4">
                <select name="jrv" id="jrv">
                    <option value="" selected>Todas las JRV</option>
                    @if($jrvsList)
                        @foreach($jrvsList as $j)
                            <option value="{{ $j }}" {{ request('jrv') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    @endif
                </select>
                <label>JRV</label>
            </div>
            @endif

            <div class="col s12" style="margin-top:25px;">
                <button type="submit" class="btn green">
                    <i class="material-icons left">filter_list</i> Filtrar
                </button>
                <a href="{{ route('estadisticas.index') }}" class="btn blue">
                    <i class="material-icons left">list</i> Mostrar Todos
                </a>
                <button type="button" id="btnExportar" class="btn amber darken-2">
                    <i class="material-icons left">file_download</i> Exportar a Excel
                </button>
            </div>
        </form>
    </div>

    <!-- Tabla de resultados por candidato -->
    <div class="card">
        <div class="card-content">
            <table class="highlight responsive-table" id="tablaEstadisticas">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Número</th>
                        <th>Nombre Candidato</th>
                        @if(request('municipio_id') || request('centro_votacion_id') || request('jrv'))
                            <th>Municipio</th>
                        @endif
                        @if(request('centro_votacion_id') || request('jrv'))
                            <th>Centro</th>
                        @endif
                        @if(request('jrv'))
                            <th>JRV</th>
                        @endif
                        <th>Votos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($datosTabla as $dato)
                        <tr>
                            <td style="text-align:center;">
                                <img src="{{ asset('images/candidatos/placeholder.png') }}" 
                                     alt="Foto" class="img-thumbnail" style="width:60px;height:60px;">
                            </td>
                            <td>{{ $dato['numero'] }}</td>
                            <td>{{ $dato['nombre'] }}</td>
                            @if(request('municipio_id') || request('centro_votacion_id') || request('jrv'))
                                <td>{{ $dato['municipio'] ?? '-' }}</td>
                            @endif
                            @if(request('centro_votacion_id') || request('jrv'))
                                <td>{{ $dato['centro'] ?? '-' }}</td>
                            @endif
                            @if(request('jrv'))
                                <td>{{ $dato['jrv'] ?? '-' }}</td>
                            @endif
                            <td><strong>{{ $dato['votos'] }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 3 + (request('municipio_id') ? 1 : 0) + (request('centro_votacion_id') ? 1 : 0) + (request('jrv') ? 1 : 0) + 1 }}" class="center-align text-muted">No hay datos disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Sección: Resultados por candidato en centros -->
<div class="container" style="margin-top:50px;">
    <h4 class="center-align">📍 Resultados por Candidato y Centro</h4>

    <div class="row">
        <form action="{{ route('estadisticas.index') }}" method="GET">
            <div class="input-field col s6">
                <select name="candidato_id" id="candidato_select" required>
                    <option value="" selected>Seleccione un Candidato</option>
                    @foreach($candidatos as $c)
                        <option value="{{ $c->id }}" {{ request('candidato_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->numero }} - {{ $c->nombre }}
                        </option>
                    @endforeach
                </select>
                <label>Candidato</label>
            </div>
            <div class="col s6" style="margin-top:20px;">
                <button type="submit" class="btn green">
                    <i class="material-icons left">search</i> Ver Resultados
                </button>
                <button type="button" id="btnExportCandidato" class="btn amber darken-2">
                    <i class="material-icons left">file_download</i> Exportar a Excel
                </button>
            </div>
        </form>
    </div>

    @if(isset($datosCandidato) && count($datosCandidato) > 0)
    <div class="card">
        <div class="card-content">
            <table class="highlight responsive-table" id="tablaCandidato">
                <thead>
                    <tr>
                        <th>Centro</th>
                        <th>Municipio</th>
                        <th>Votos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datosCandidato as $dato)
                        <tr>
                            <td>{{ $dato['centro'] }}</td>
                            <td>{{ $dato['municipio'] }}</td>
                            <td><strong>{{ $dato['votos'] }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @elseif(request('candidato_id'))
        <p class="center-align">No hay resultados para el candidato seleccionado.</p>
    @endif
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    M.FormSelect.init(document.querySelectorAll('select'));
});

// Cargar centros según municipio
$('#municipio').on('change', function() {
    var municipioId = $(this).val();
    var centroSelect = $('#centro');
    var jrvSelect = $('#jrv');

    if (centroSelect.length) centroSelect.prop('disabled', true).html('<option>Cargando...</option>');
    if (jrvSelect.length) jrvSelect.prop('disabled', true).html('<option>Todas las JRV</option>');

    if (municipioId) {
        $.get('/api/centros/' + municipioId, function(data) {
            if (centroSelect.length) {
                centroSelect.empty().append('<option value="">Todos los Centros</option>');
                $.each(data, function(i, c) {
                    centroSelect.append('<option value="'+c.id+'">'+c.nombre+'</option>');
                });
                centroSelect.prop('disabled', false);
                M.FormSelect.init(centroSelect);
            }
        });
    }
});

// Cargar JRVs según centro
$('#centro').on('change', function() {
    var centroId = $(this).val();
    var municipioId = $('#municipio').val();
    var jrvSelect = $('#jrv');

    if (!jrvSelect.length) return;
    jrvSelect.prop('disabled', true).html('<option>Todas las JRV</option>');

    if (centroId && municipioId) {
        $.get('/api/jrvs/' + municipioId + '/' + centroId, function(data) {
            jrvSelect.empty().append('<option value="">Todas las JRV</option>');
            $.each(data, function(i, j) {
                jrvSelect.append('<option value="'+j+'">'+j+'</option>');
            });
            jrvSelect.prop('disabled', false);
            M.FormSelect.init(jrvSelect);
        });
    }
});

// Exportar tabla general a Excel
$('#btnExportar').click(function() {
    var tablaClon = $('#tablaEstadisticas').clone();
    tablaClon.find('th:first-child, td:first-child').remove(); // quitar columna foto
    var html = `<html xmlns:o="urn:schemas-microsoft-com:office:office"
                     xmlns:x="urn:schemas-microsoft-com:office:excel"
                     xmlns="http://www.w3.org/TR/REC-html40">
                    <head><meta charset="UTF-8"></head>
                    <body>${tablaClon.prop('outerHTML')}</body></html>`;
    var blob = new Blob([html], { type: 'application/vnd.ms-excel' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'estadisticas_candidatos.xls';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});

// Exportar tabla de candidato a Excel
$('#btnExportCandidato').click(function() {
    var tablaClon = $('#tablaCandidato').clone();
    if(!tablaClon.length) return alert('Seleccione un candidato y cargue los resultados.');
    var html = `<html xmlns:o="urn:schemas-microsoft-com:office:office"
                     xmlns:x="urn:schemas-microsoft-com:office:excel"
                     xmlns="http://www.w3.org/TR/REC-html40">
                    <head><meta charset="UTF-8"></head>
                    <body>${tablaClon.prop('outerHTML')}</body></html>`;
    var blob = new Blob([html], { type: 'application/vnd.ms-excel' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'resultados_candidato.xls';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});
</script>
@endsection
