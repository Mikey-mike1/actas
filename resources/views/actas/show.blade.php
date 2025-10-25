@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detalle del Acta {{ $acta->jrv }}</h4>

    <p><strong>Municipio:</strong> {{ $acta->municipio->nombre ?? '-' }}</p>
    <p><strong>Centro de Votación:</strong> {{ $acta->centro->nombre ?? '-' }}</p>
    <p><strong>JRV:</strong> {{ $acta->jrv }}</p>
    <p><strong>Observaciones:</strong> {{ $acta->observaciones ?? '-' }}</p>

    @if($acta->pdf_path)
        <p><a href="{{ Storage::url($acta->pdf_path) }}" target="_blank" class="btn blue">Ver PDF</a></p>
    @endif

    <h5>Resultados</h5>

    <button id="btnExportar" class="btn green darken-2" style="margin-bottom: 12px;">
        <i class="material-icons left">file_download</i> Exportar a Excel
    </button>

    <table id="tablaResultados" class="highlight responsive-table">
        <thead>
            <tr>
                <th>Número</th>
                <th>Candidato</th>
                <th>Partido</th>
                <th>Votos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($acta->resultados->sortByDesc('votos') as $resultado)
                <tr>
                    <td>{{ $resultado->candidato->numero ?? '-' }}</td>
                    <td>{{ $resultado->candidato->nombre ?? '-' }}</td>
                    <td>{{ $resultado->candidato->partido->nombre ?? '-' }}</td>
                    <td>{{ $resultado->votos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- jQuery (si no lo tienes en tu layout) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$('#btnExportar').click(function() {
    // Clonamos la tabla para asegurar que no se altere la original
    var tablaClon = $('#tablaResultados').clone();

    // Convertir la tabla a HTML en formato compatible con Excel
    var html = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" 
              xmlns:x="urn:schemas-microsoft-com:office:excel" 
              xmlns="http://www.w3.org/TR/REC-html40">
        <head>
            <meta charset="UTF-8">
            <style>
                table, th, td {
                    border: 1px solid #000;
                    border-collapse: collapse;
                }
                th {
                    background-color: #d9e1f2;
                    font-weight: bold;
                }
                td, th {
                    padding: 4px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            <h3>Resultados del Acta {{ $acta->jrv }}</h3>
            ${tablaClon.prop('outerHTML')}
        </body>
        </html>
    `;

    // Crear archivo Excel como Blob
    var blob = new Blob([html], { type: 'application/vnd.ms-excel' });
    var url = URL.createObjectURL(blob);

    // Descargar el archivo
    var a = document.createElement('a');
    a.href = url;
    a.download = 'Resultados_Acta_{{ preg_replace("/[^A-Za-z0-9_-]/", "_", $acta->jrv) }}.xls';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});
</script>
@endsection
