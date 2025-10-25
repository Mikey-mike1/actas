@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="center-align">Listado de Actas</h4>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="card-panel green lighten-4 green-text text-darken-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtros -->
    <div class="row">
        <form action="{{ route('actas.listar') }}" method="GET">
            <div class="input-field col s4">
                <select name="municipio_id" id="municipio">
                    <option value="" selected>Seleccione Municipio</option>
                    @foreach($municipios as $m)
                        <option value="{{ $m->id }}" {{ request('municipio_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->nombre }}
                        </option>
                    @endforeach
                </select>
                <label>Municipio</label>
            </div>

            <div class="input-field col s4">
                <select name="centro_votacion_id" id="centro">
                    <option value="" selected>Seleccione Centro</option>
                    @foreach($centros as $c)
                        <option value="{{ $c->id }}" {{ request('centro_votacion_id') == $c->id ? 'selected' : '' }}>
                            {{ $c->nombre }}
                        </option>
                    @endforeach
                </select>
                <label>Centro de Votación</label>
            </div>

            <div class="col s4" style="margin-top:25px;">
                <button type="submit" class="btn green">
                    <i class="material-icons left">filter_list</i> Filtrar
                </button>
                <a href="{{ route('actas.listar') }}" class="btn blue">
                    <i class="material-icons left">list</i> Mostrar Todas
                </a>
                <button type="button" id="btnExportar" class="btn amber darken-2">
                    <i class="material-icons left">file_download</i> Exportar a Excel
                </button>
            </div>
        </form>
    </div>

    <!-- Tabla de actas -->
    <div class="card">
        <div class="card-content">
            <table id="tablaActas" class="highlight responsive-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Municipio</th>
                        <th>Centro</th>
                        <th>JRV</th>
                        <th>Observaciones</th>
                        <th>PDF</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($actas as $acta)
                        <tr>
                            <td>{{ $acta->id }}</td>
                            <td>{{ $acta->municipio->nombre ?? '-' }}</td>
                            <td>{{ $acta->centro->nombre ?? '-' }}</td>
                            <td>{{ $acta->jrv }}</td>
                            <td>{{ $acta->observaciones ?? '-' }}</td>
                            <td>
                                @if($acta->pdf_path)
                                    <a href="{{ Storage::url($acta->pdf_path) }}" target="_blank" class="btn-small grey darken-1">
                                        <i class="material-icons left">picture_as_pdf</i> Ver PDF
                                    </a>
                                @else
                                    Sin PDF
                                @endif
                            </td>
                            <td>{{ $acta->created_at }}</td>
                            <td>{{ $acta->updated_at }}</td>
<td>
    {{-- Botón EDITAR: visible para ADMIN, SUPERVISOR y DIGITADOR --}}
    @if(in_array(Auth::user()->rol, ['admin', 'supervisor', 'digitador']))
        <a href="{{ route('actas.edit', $acta->id) }}" class="btn-small orange">
            Editar
        </a>
    @endif

    {{-- Botón VER: visible para todos --}}
    <a href="{{ route('actas.show', $acta->id) }}" class="btn-small blue">
         Ver
    </a>

    {{-- Botón BORRAR: solo ADMIN y SUPERVISOR --}}
    @if(in_array(Auth::user()->rol, ['admin', 'supervisor']))
        <form action="{{ route('actas.destroy', $acta->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-small red" onclick="return confirm('¿Seguro que quieres borrar esta acta?')">
                BORRAR
        </form>
    @endif
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="center-align">No hay actas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Materialize --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
let ultimaActualizacion = null;

function cargarTabla() {
    $.get('{{ route("actas.listar") }}', function(data) {
        var nuevaTabla = $(data).find('#tablaActas tbody').html();
        $('#tablaActas tbody').html(nuevaTabla);
    });
}

function verificarCambios() {
    $.get('/api/actas/ultima-actualizacion', function(response) {
        if (!ultimaActualizacion) {
            ultimaActualizacion = response.ultima_actualizacion;
        } else if (response.ultima_actualizacion !== ultimaActualizacion) {
            ultimaActualizacion = response.ultima_actualizacion;
            cargarTabla();
        }
    });
}

// Verificar cada 5 segundos
setInterval(verificarCambios, 5000);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    M.FormSelect.init(document.querySelectorAll('select'));
});

// Cargar centros dinámicamente según el municipio
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

// --- Exportar tabla a Excel con jQuery ---
$('#btnExportar').click(function() {
    // Clonamos la tabla para eliminar la columna de "Acciones"
    var tablaClon = $('#tablaActas').clone();
    tablaClon.find('th:last-child, td:last-child').remove(); // quita columna de acciones

    // Convertir la tabla a HTML
    var html = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" 
              xmlns:x="urn:schemas-microsoft-com:office:excel" 
              xmlns="http://www.w3.org/TR/REC-html40">
        <head>
            <meta charset="UTF-8">
        </head>
        <body>
            ${tablaClon.prop('outerHTML')}
        </body>
        </html>
    `;

    // Crear archivo Excel
    var blob = new Blob([html], { type: 'application/vnd.ms-excel' });
    var url = URL.createObjectURL(blob);

    // Descargar el archivo
    var a = document.createElement('a');
    a.href = url;
    a.download = 'actas.xls';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});
</script>
@endsection
