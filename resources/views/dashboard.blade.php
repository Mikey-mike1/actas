@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="center-align">Votos por Municipio</h4>

    <div class="card">
        <div class="card-content" style="text-align: center; display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <svg id="mapa" viewBox="100 50 800 700" style="max-width: 100%; border: 1px solid #ccc;">

<polygon id="tegucigalpa" data-id="1" points="459,473,459,462,462,449,458,438,449,438,445,424,437,410,433,402,440,396,447,392,440,380,434,374,435,358,441,349,447,345,453,336,461,336,469,338,474,340,480,338,492,338,501,332,511,331,521,334,527,334,536,337,534,351,529,360,537,364,541,368,536,374,541,383,547,387,554,390,563,392,569,392,569,397,563,402,556,410,548,416,539,420,534,433,536,442,540,450,545,447,551,443,559,443,556,449,557,456,549,462,542,468,539,474,539,485,538,491,537,499,545,502,543,510,538,520,529,510,523,503,511,495,504,491,494,487,483,479,475,473,466,472" fill="#ff9999" stroke="#000" stroke-width="2" data-name="Distrito Central"></polygon>
<polygon id="lepaterique" data-id="9" points="393,494,394,504,405,511,416,511,429,507,437,507,442,499,448,499,453,492,451,483,458,477,459,466,460,452,462,444,453,436,446,430,439,410,434,405,429,411,421,421,412,426,401,429,393,432,389,446,391,463,391,478" fill="#99ff99" stroke="#000" stroke-width="2" data-name="Lepaterique"></polygon>
<polygon id="reitoca" data-id="15" points="426,552,425,543,428,536,427,529,425,520,426,511,432,510,439,510,447,508,453,510,457,519,460,534,464,545,461,552,462,561,460,570,460,579,451,579,450,570,441,565,431,557,436,559" fill="#9999ff" stroke="#000" stroke-width="2" data-name="Reitoca"></polygon>
<polygon id="curaren" data-id="4" points="410,591,415,580,416,566,419,557,426,553,426,538,429,525,428,515,428,512,419,510,407,510,397,503,391,513,390,525,388,535,384,545,381,553,381,561,378,573,378,585,387,588,394,595,401,597" fill="#ffcc99" stroke="#000" stroke-width="2" data-name="Curaren"></polygon>
<polygon id="la_libertad" data-id="7" points="418 590 432 596 439 608 434 612 424 609 413 600" fill="#cc99ff" stroke="#000" stroke-width="2" data-name="La libertad"></polygon>
<polygon id="san_miguelito" data-id="21" points="416,585,415,576,413,566,422,566,429,572,436,575,438,584,438,592,432,592,425,592" fill="#99ffcc" stroke="#000" stroke-width="2" data-name="San Miguelito"></polygon>
<polygon id="alubaren" data-id="2" points="420,553,429,554,435,560,441,566,448,569,448,578,442,578,436,576,426,571,419,566" fill="#ff99cc" stroke="#000" stroke-width="2" data-name="Alubaren"></polygon>
<polygon id="la_venta" data-id="8" points="463 566 468 567 476 576 487 576 492 586 495 599 494 606 483 607 469 606 459 601 456 590" fill="#cccc99" stroke="#000" stroke-width="2" data-name="La Venta"></polygon>
<polygon id="sabanagrande" data-id="16" points="460,565,464,560,466,554,466,546,472,546,474,556,480,550,486,544,493,541,495,530,502,527,511,531,515,543,517,557,517,569,518,582,515,594,509,598,507,604,499,608,496,597,495,588,492,582,489,578,482,578,474,576,470,568" fill="#ff9999" stroke="#000" stroke-width="2" data-name="Sabanagrande"></polygon>
<polygon id="ojojona" data-id="13" points="453,512,457,520,461,531,461,539,463,545,471,544,472,552,478,552,483,545,490,540,495,527,486,517,486,510,491,507,495,499,497,492,490,485,481,480,471,472,464,476,454,482,451,495,446,500,438,501,442,507" fill="#99ff99" stroke="#000" stroke-width="2" data-name="Ojojona"></polygon>
<polygon id="santa_ana" data-id="22" points="488,519,489,511,492,502,499,496,499,486,507,490,512,496,520,498,527,508,533,517,537,525,533,535,530,524,524,517,523,508,515,506,511,512,508,521,502,527,492,525" fill="#9999ff" stroke="#000" stroke-width="2" data-name="Santa Ana"></polygon>
<polygon id="san_buena_aventura" data-id="18" points="505,524,512,534,514,544,523,547,530,545,530,535,527,522,524,509,512,509,521,500,509,516" fill="#ffcc99" stroke="#000" stroke-width="2" data-name="San Buena Aventura"></polygon>
<polygon id="nueva_armenia" data-id="12" points="504,608,508,598,515,591,515,578,515,563,515,551,523,543,533,544,540,553,540,561,537,570,537,579,542,588,547,598,542,605,537,613,539,621,527,614,518,610,512,617" fill="#cc99ff" stroke="#000" stroke-width="2" data-name="Nueva Armenia"></polygon>
<polygon id="maraita" data-id="10" points="529 540 538 528 545 511 553 502 558 509 568 506 574 496 577 503 577 511 573 525 579 535 576 548 575 560 570 568 558 572 546 565" fill="#99ffcc" stroke="#000" stroke-width="2" data-name="Maraita"></polygon>
<polygon id="tatumbla" data-id="25" points="537,500,546,503,553,507,562,509,572,507,572,503,572,493,566,483,558,476,552,470,543,470,539,476,539,486" fill="#ff99cc" stroke="#000" stroke-width="2" data-name="Tatumbla"></polygon>
<polygon id="san_antonio_de_oriente" data-id="17" points="542,471,549,465,558,459,557,449,567,445,574,439,579,439,586,448,592,459,602,468,600,483,595,497,589,503,578,499,570,490,562,483,554,474" fill="#cccc99" stroke="#000" stroke-width="2" data-name="San Antonio de Oriente"></polygon>
<polygon id="santa_luci­a" data-id="23" data-id="1" points="540,449,533,440,533,427,539,420,547,413,553,411,556,424,559,436,555,443,549,449" fill="#ff9999" stroke="#000" stroke-width="2" data-name="Santa Luci­a"></polygon>
<polygon id="valle_de_angeles" data-id="26" points="600,430,591,430,583,427,577,436,571,443,559,445,553,430,552,414,559,407,565,405,568,398,574,394,575,410,577,420,591,423,588,424,591,423,599,424" fill="#99ff99" stroke="#000" stroke-width="2" data-name="Valle de Angeles"></polygon>
<polygon id="villa_de_san_francisco" data-id="27" points="574,417,583,420,590,423,600,426,606,418,597,413,603,405,606,392,594,389,584,389,577,388,569,391,571,401,569,410" fill="#9999ff" stroke="#000" stroke-width="2" data-name="Villa de San Francisco"></polygon>
<polygon id="san_juan_flores" data-id="20" points="536,380,539,370,545,361,550,351,556,344,562,338,571,337,575,328,580,325,588,328,596,331,604,335,610,337,618,345,625,356,626,363,620,373,612,382,606,391,594,392,578,389,569,388,564,394,549,388" fill="#ffcc99" stroke="#000" stroke-width="2" data-name="San Juan Flores"></polygon>
<polygon id="talaganga" data-id="24" points="503,332,510,335,517,335,522,335,530,335,538,342,535,353,531,359,535,362,545,363,550,355,554,347,560,343,566,339,573,335,577,327,585,327,592,329,598,334,601,328,606,323,608,312,602,305,593,302,583,298,573,293,563,292,555,294,542,293,533,293,522,294,516,298,510,306,506,314,505,322" fill="#cc99ff" stroke="#000" stroke-width="2" data-name="Talaganga"></polygon>
<polygon id="cedros" data-id="3" points="454,334,460,334,468,338,478,338,487,338,494,337,503,331,505,321,505,312,511,302,515,295,524,292,534,292,544,293,553,293,561,292,567,281,563,268,562,259,561,249,561,238,556,227,547,218,539,218,533,215,526,210,521,204,514,208,508,214,507,230,505,242,503,250,499,255,486,257,480,255,472,255,475,266,479,270,482,279,477,287,467,295,458,303,449,302,450,309,446,316,453,317,453,325" fill="#99ffcc" stroke="#000" stroke-width="2" data-name="Cedros"></polygon>
<polygon id="vallecillo" data-id="28" points="451,306,460,303,466,298,474,290,482,284,480,274,473,265,472,255,469,246,472,238,461,239,451,233,448,244,448,254,438,262,431,271,432,283,436,293,441,299" fill="#ff99cc" stroke="#000" stroke-width="2" data-name="Vallecillo"></polygon>
<polygon id="guaimaca" data-id="6" points="562,290,562,278,564,267,561,252,561,237,568,236,574,229,577,223,578,217,585,221,594,223,606,224,615,224,623,221,634,227,639,234,644,240,648,248,650,258,653,272,654,283,660,299,661,313,653,322,644,332,632,342,625,351,615,344,610,334,600,331,606,322,609,313,603,306,591,299,578,294" fill="#cccc99" stroke="#000" stroke-width="2" data-name="Guaimaca"></polygon>
<polygon id="el_porvenir" data-id="5" points="470,254,470,244,474,230,475,219,487,204,493,194,494,176,491,157,494,146,505,147,508,140,519,141,527,149,532,157,528,166,531,178,538,190,539,201,538,216,530,213,524,207,515,207,508,219,505,232,504,244,501,252,495,255,483,257" fill="#ff9999" stroke="#000" stroke-width="2" data-name="El Porvenir"></polygon>
<polygon id="san_ignacio" data-id="19" points="527 159 531 150 525 141 538 142 547 142 556 142 563 145 565 154 570 164 574 175 575 186 575 199 576 210 575 220 573 229 565 235 558 229 552 218 541 215 535 191 531 182 525 172" fill="#99ff99" stroke="#000" stroke-width="2" data-name="San Ignacio"></polygon>
<polygon id="orica" data-id="14" points="577,214,577,199,577,185,575,172,568,160,562,147,559,138,565,129,574,119,580,109,588,109,596,115,593,124,593,134,597,140,600,148,600,159,606,167,604,173,609,186,612,198,616,213,623,220,615,226,600,226,588,224" fill="#9999ff" stroke="#000" stroke-width="2" data-name="Orica"></polygon>
<polygon id="marale" data-id="11" points="505,137,512,141,524,142,534,142,547,141,556,141,562,132,571,126,575,118,578,112,587,112,596,109,600,105,591,99,584,91,577,83,571,72,559,71,547,71,536,68,526,69,515,74,509,88,509,100,505,107,507,119,511,128" fill="#ffcc99" stroke="#000" stroke-width="2" data-name="Marale"></polygon>



            </svg>

            <div class="tooltip" id="tooltip"></div>
        </div>
    </div>
</div>

<!-- Modal de votos -->
<div id="modal-votos" class="modal">
    <div class="modal-content">
        <h5 id="modal-municipio-nombre">Votos por Candidato</h5>
        <table class="highlight" id="tabla-votos">
            <thead>
                <tr>
                    <th>Candidato</th>
                    <th>Votos</th>
                </tr>
            </thead>
            <tbody>
                <!-- Se llena dinámicamente -->
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button id="btnExportarExcel" class="btn green waves-effect waves-light">
            📊 Exportar a Excel
        </button>
        <a href="#!" class="modal-close btn red">Cerrar</a>
    </div>
</div>

<style>
.tooltip {
    position: absolute;
    background: rgba(0,0,0,0.75);
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    display: none;
    pointer-events: none;
    font-size: 13px;
    white-space: pre-line;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tooltip = document.getElementById('tooltip');
    const votosMunicipios = @json($municipiosVotos); // {idMunicipio: {candidato: votos,...}, ...}
    const modal = document.getElementById('modal-votos');
    const tablaBody = document.querySelector('#tabla-votos tbody');
    const modalTitulo = document.getElementById('modal-municipio-nombre');
    const btnExportar = document.getElementById('btnExportarExcel');

    let municipioActual = ""; // guardará el nombre del municipio activo

    // Inicializar modal de Materialize
    M.Modal.init(modal);

    document.querySelectorAll('svg polygon').forEach(poly => {
        const municipioId = poly.dataset.id;
        const municipioNombre = poly.dataset.name;

        // Tooltip solo con el nombre
        poly.addEventListener('mouseover', e => {
            tooltip.style.display = 'block';
            tooltip.textContent = municipioNombre;
            poly.setAttribute('fill-opacity', '0.7');
        });

        poly.addEventListener('mousemove', e => {
            tooltip.style.top = (e.pageY + 10) + 'px';
            tooltip.style.left = (e.pageX + 10) + 'px';
        });

        poly.addEventListener('mouseout', e => {
            tooltip.style.display = 'none';
            poly.setAttribute('fill-opacity', '1');
        });

        // Click para mostrar modal con tabla de votos
        poly.addEventListener('click', e => {
            const votos = votosMunicipios[municipioId] || {};
            tablaBody.innerHTML = '';

            // Ordenar votos descendente y llenar tabla
            Object.entries(votos)
                .sort((a,b) => b[1]-a[1])
                .forEach(([candidato, cantidad]) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td>${candidato}</td><td>${cantidad}</td>`;
                    tablaBody.appendChild(tr);
                });

            municipioActual = municipioNombre;
            modalTitulo.textContent = `Votos en ${municipioNombre}`;
            const instance = M.Modal.getInstance(modal);
            instance.open();
        });
    });

    // Exportar tabla a Excel
    btnExportar.addEventListener('click', function() {
        const tablaClon = document.getElementById('tabla-votos').cloneNode(true);

        // Convertir la tabla a HTML
        const html = `
            <html xmlns:o="urn:schemas-microsoft-com:office:office"
                  xmlns:x="urn:schemas-microsoft-com:office:excel"
                  xmlns="http://www.w3.org/TR/REC-html40">
            <head><meta charset="UTF-8"></head>
            <body>
                <h3>Resultados - ${municipioActual}</h3>
                ${tablaClon.outerHTML}
            </body>
            </html>
        `;

        // Crear archivo Excel
        const blob = new Blob([html], { type: 'application/vnd.ms-excel' });
        const url = URL.createObjectURL(blob);

        // Descargar el archivo
        const a = document.createElement('a');
        a.href = url;
        a.download = `votos_${municipioActual.replace(/\s+/g, '_')}.xls`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });
});
</script>
@endsection
