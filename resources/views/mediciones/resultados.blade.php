@extends('layout/plantilla')

@section('tituloPagina', 'Pagina Principal')

@section('contenido')
<style>
    :root {
        --dark-gray: #2d3748;
        --medium-gray: #4a5568;
        --light-gray: #718096;
        --lighter-gray: #e2e8f0;
        --blue-accent: #4299e1;
        --red-accent: #fc8181;
        --green-accent: #68d391;
    }
    
    body {
        background-color: #f7fafc;
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
    }
    
    .table-card {
    background-color: var(--dark-gray);
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    width: 100%;  /* Asegura que ocupe todo el ancho disponible */
    max-width: none;  /* Elimina cualquier máximo de ancho */
}
    
    .table-title {
        color: white;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        letter-spacing: 0.5px;
        font-size: 2rem;
        margin-bottom: 1.5rem !important;
        position: relative;
        display: inline-block;
    }
    
    .table-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--blue-accent), var(--green-accent));
        border-radius: 3px;
    }
    
    .custom-table {
        width: 100% !important;
    color: white;
    margin-bottom: 0;
    font-size: 0.95rem;
    border-collapse: separate;
    border-spacing: 0;
    }
    
    .custom-table thead {
        background-color: rgba(74, 85, 104, 0.9);
        color: white;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        backdrop-filter: blur(5px);
    }
    
    .custom-table thead th {
    font-weight: 700;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
    padding: 15px 20px !important;  /* Aumenté el padding horizontal */
    border: none;
}
    
    .custom-table tbody tr {
        background-color: var(--dark-gray);
        border-bottom: 1px solid var(--light-gray);
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .custom-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .custom-table tbody tr:hover {
        background-color: var(--medium-gray);
        border-left: 3px solid var(--blue-accent);
        transform: translateX(2px);
    }
    
    .custom-table tbody td {
    font-weight: 400;
    padding: 12px 20px !important;  /* Aumenté el padding horizontal */
    vertical-align: middle;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}
    
    .custom-table tbody td:first-child {
        font-weight: 600;
        color: var(--lighter-gray);
        border-left: 3px solid transparent;
    }
    
    .badge-sensor {
        background-color: var(--light-gray);
        color: white;
        font-weight: 500;
        font-family: 'Roboto Condensed', sans-serif;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
        padding: 6px 12px !important;
    }
    
    .bg-gray-700 {
        font-family: 'Roboto Condensed', sans-serif;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
        padding: 6px 12px !important;
    }
    
    .map-link {
        color: var(--blue-accent);
        font-weight: 600;
        transition: all 0.2s;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .map-link:hover {
        color: #ebf8ff;
        text-decoration: none;
        transform: translateX(3px);
    }
    
    .rain-high {
        color: var(--red-accent);
        font-weight: 600;
        font-size: 1.05rem;
        text-shadow: 0 0 4px rgba(252, 129, 129, 0.3);
    }
    
    .rain-low {
        color: var(--green-accent);
        font-weight: 600;
        font-size: 1.05rem;
        text-shadow: 0 0 4px rgba(104, 211, 145, 0.3);
    }
    
    .secondary-text {
        color: var(--lighter-gray);
        font-family: 'Roboto Mono', monospace;
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .table-footer {
        background-color: var(--medium-gray);
        border-top: 1px solid var(--light-gray);
        padding: 15px 20px !important;
    }
    
    .table-footer div {
        font-size: 0.95rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    
    .export-btn {
        background-color: var(--blue-accent);
        border: none;
        transition: all 0.3s;
        font-weight: 600;
        letter-spacing: 0.3px;
        font-size: 0.95rem;
        padding: 10px 20px !important;
        border-radius: 50px !important;
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .export-btn:hover {
        background-color: #3182ce;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
    }
    
    .export-btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }
    
    .export-btn:hover::after {
        left: 100%;
    }
    
    .pagination {
        --bs-pagination-border-width: 1px;
        --bs-pagination-font-size: 1.1rem;
        margin-top: 2rem;
    }
    
    .page-link {
        margin: 0 0.3rem;
        border-radius: 50% !important;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-weight: 600;
        border: none;
    }
    
    .page-link:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .page-item.active .page-link {
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        transform: scale(1.05);
    }
    
    .page-item.disabled .page-link {
        opacity: 0.5;
    }
    
    .bi {
        vertical-align: middle;
        font-size: 1.1em;
        transition: all 0.2s ease;
    }
    
    /* Efecto para los iconos en las celdas */
    .custom-table tbody td .bi {
        filter: drop-shadow(0 1px 1px rgba(0,0,0,0.2));
    }
    
    /* Estilos para el filtro de fecha */
    .filter-container {
        background-color: var(--medium-gray);
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }
    
    .filter-label {
        color: white;
        font-weight: 600;
        margin-right: 10px;
    }
    
    .filter-btn {
        background-color: var(--blue-accent);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .filter-btn:hover {
        background-color: #3182ce;
        transform: translateY(-2px);
    }
    
    .filter-btn.active {
        background-color: var(--green-accent);
        box-shadow: 0 0 0 2px rgba(104, 211, 145, 0.5);
    }
    
    /* Estilos para el modal */
    .modal-content {
        background-color: var(--dark-gray);
        color: white;
        border: 1px solid var(--light-gray);
    }
    
    .modal-header {
        border-bottom: 1px solid var(--light-gray);
    }
    
    .modal-footer {
        border-top: 1px solid var(--light-gray);
    }
    
    .form-control, .form-control:focus {
        background-color: var(--medium-gray);
        color: white;
        border: 1px solid var(--light-gray);
    }
    
    .form-label {
        color: var(--lighter-gray);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table-title {
            font-size: 1.5rem;
        }
        
        .custom-table thead th {
            font-size: 0.8rem;
            padding: 10px 8px;
        }
        
        .custom-table tbody td {
            padding: 8px 10px !important;
            font-size: 0.85rem;
        }
        
        .export-btn {
            padding: 8px 15px !important;
            font-size: 0.85rem;
        }
        
        .filter-container {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="container py-2 d-flex flex-column align-items-center">
    <h2 class="text-center mb-4 table-title">
        <i class="mdi mdi-weather-hail me-2"></i> Registros de Pluviómetros
    </h2>
    
    <!-- Filtro de fecha -->
    <div class="filter-container w-100">
    <span class="filter-label">Filtrar por fecha:</span>
    
    <a href="{{ url('mediciones?filter=last7days') }}" id="recentDataBtn" class="filter-btn">
        <i class="bi bi-calendar-week"></i> Últimos 7 días
    </a>
    
    <button id="customRangeBtn" class="filter-btn" data-bs-toggle="modal" data-bs-target="#dateRangeModal">
        <i class="bi bi-calendar-range"></i> Rango personalizado
    </button>
    
    <div class="ms-auto">
        <span class="secondary-text">
            <i class="bi bi-info-circle me-2"></i>
            Mostrando {{ $filterApplied }} registros
        </span>
    </div>
</div>
    
   <!-- Modal para rango de fechas -->
<!-- Modal para rango de fechas -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateRangeModalLabel">Seleccionar rango de fechas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Fecha de inicio arriba -->
                <div class="mb-4">
                    <h6>Fecha de inicio</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="startMonth" class="form-label">Mes</label>
                            <select class="form-select" id="startMonth">
                                @foreach([1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 
                                         7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'] as $monthNum => $monthName)
                                    @if($availableMonths->contains($monthNum))
                                        <option value="{{ $monthNum }}">{{ $monthName }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="startYear" class="form-label">Año</label>
                            <select class="form-select" id="startYear">
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Fecha de fin abajo -->
                <div class="mb-4">
                    <h6>Fecha de fin</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="endMonth" class="form-label">Mes</label>
                            <select class="form-select" id="endMonth">
                                @foreach([1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 
                                         7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'] as $monthNum => $monthName)
                                    @if($availableMonths->contains($monthNum))
                                        <option value="{{ $monthNum }}">{{ $monthName }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="endYear" class="form-label">Año</label>
                            <select class="form-select" id="endYear">
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="applyDateRange">Aplicar filtro</button>
            </div>
        </div>
    </div>
</div>
    
    <div class="table-card">
        <div class="table-responsive-lg">
            <table class="table custom-table table-hover">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Lluvia (mm)</th>
                        <th>Lluvia (cm)</th>
                        <th>Ubicación</th>
                        <th class="pe-4">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $dato)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $dato->id }}</td>
                       
                        <td class="{{ $dato->cantidad_lluvia > 10 ? 'rain-high' : 'rain-low' }}">
                            {{ $dato->cantidad_lluvia }} mm
                            @if($dato->cantidad_lluvia > 10)
                            <i class="bi bi-exclamation-triangle-fill ms-2"></i>
                            @endif
                        </td>
                        <td class="{{ $dato->cantidad_lluvia > 10 ? 'rain-high' : 'rain-low' }}">
                            {{ $dato->cantidad_lluvia/10 }} cm
                            @if($dato->cantidad_lluvia > 10)
                            <i class="bi bi-exclamation-triangle-fill ms-2"></i>
                            @endif
                        </td>
                        <td>
                            <a href="https://maps.google.com?q={{ $dato->latitud }},{{ $dato->longitud }}" 
                               target="_blank" 
                               class="map-link">
                                <i class="bi bi-geo-alt-fill me-2"></i>Mapa
                            </a>
                        </td>
                        <td class="pe-4 secondary-text">
                        {{ \Carbon\Carbon::parse($dato->created_at)->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center p-3 table-footer">
            <div class="secondary-text">
                <i class="bi bi-database me-2"></i>Total {{ $datos->count() }} registros
            </div>
            <div>
                <button onclick="exportToCSV()" class="btn export-btn text-white px-4 py-2">
                    <i class="bi bi-download me-2"></i>Exportar CSV
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Paginación personalizada -->
<div class="d-flex justify-content-center mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg">
            {{-- Previous Page Link --}}
            @if ($datos->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link bg-dark border-light text-light">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link bg-dark border-light text-light" href="{{ $datos->previousPageUrl() }}" aria-label="Previous">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($datos->getUrlRange(1, $datos->lastPage()) as $page => $url)
                @if ($page == $datos->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link bg-primary border-primary">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link bg-dark border-light text-light" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($datos->hasMorePages())
                <li class="page-item">
                    <a class="page-link bg-dark border-light text-light" href="{{ $datos->nextPageUrl() }}" aria-label="Next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link bg-dark border-light text-light">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
</div>
<script>
$(document).ready(function() {
    let exportBtn; // Declaramos exportBtn fuera del try para acceder en finally

    function exportToCSV() {
        try {
            // Obtener el botón y mostrar estado de carga
            exportBtn = $(this);
            const originalHtml = exportBtn.html();
            exportBtn.html('<i class="bi bi-arrow-clockwise me-2"></i>Generando...').prop('disabled', true);

            // Obtener datos de la tabla
            const table = $('.custom-table')[0];
            const rows = $(table).find('tr');
            const csvRows = [];

            // Procesar cada fila
            rows.each(function() {
                const cols = $(this).find('td, th');
                const rowData = [];

                cols.each(function() {
                    let text = $(this).text().trim()
                        .replace(/[\n\r]+/g, ' ')
                        .replace(/\s{2,}/g, ' ');

                    if (text.includes(',')) {
                        text = `"${text}"`;
                    }

                    rowData.push(text);
                });

                csvRows.push(rowData.join(','));
            });

            // Crear contenido CSV
            const csvContent = csvRows.join('\n');

            // Crear enlace de descarga
            const blob = new Blob(["\uFEFF" + csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);

            // Usar setTimeout para asegurar que el botón se restablezca
            const link = $('<a>', {
                'href': url,
                'download': `pluviometros_${new Date().toISOString().slice(0, 10)}.csv`
            }).on('click', function() {
                setTimeout(function() {
                    exportBtn.html(originalHtml).prop('disabled', false);
                    URL.revokeObjectURL(url);
                }, 100);
            }).appendTo('body').get(0); // Convert jQuery object to DOM element

            link.click();
            $('body').remove(link);

        } catch (error) {
            console.error('Error al exportar CSV:', error);
            alert('Ocurrió un error al exportar los datos. Por favor intente nuevamente.');
            if (exportBtn) {
                exportBtn.html(exportBtn.data('original-html')).prop('disabled', false);
            }
        }
    }

    // Asignar evento al botón de exportar usando jQuery
    $('.export-btn').on('click', exportToCSV).each(function() {
        $(this).data('original-html', $(this).html());
    });

    // Botones de filtro de fecha y modal
    const recentDataBtn = $('#recentDataBtn');
    const customRangeBtn = $('#customRangeBtn');
    const applyDateRangeBtn = $('#applyDateRange');
    const dateRangeModal = $('#dateRangeModal');
    const startMonthSelect = $('#startMonth');
    const startYearSelect = $('#startYear');
    const endMonthSelect = $('#endMonth');
    const endYearSelect = $('#endYear');

    // Manejar clic en "Últimos 7 días"
    recentDataBtn.on('click', function(e) {
        e.preventDefault();
        if ($(this).hasClass('active')) return;
        $(this).addClass('active').siblings('.filter-btn').removeClass('active');
        window.location.href = "{{ url('mediciones?filter=last7days') }}";
    });

    // Manejar clic en "Aplicar filtro" en el modal
    applyDateRangeBtn.on('click', function(e) {
        e.preventDefault();
        const startMonth = startMonthSelect.val();
        const startYear = startYearSelect.val();
        const endMonth = endMonthSelect.val();
        const endYear = endYearSelect.val();

        if (!startMonth || !startYear || !endMonth || !endYear) {
            alert('Por favor seleccione mes y año de inicio y fin.');
            return;
        }

        const startDate = `${startYear}-${startMonth.padStart(2, '0')}-01`;
        const endDate = `${endYear}-${endMonth.padStart(2, '0')}-${new Date(endYear, endMonth, 0).getDate()}`;

        dateRangeModal.modal('hide'); // Usar el método de jQuery para ocultar el modal
        recentDataBtn.removeClass('active');
        customRangeBtn.addClass('active');
        window.location.href = `{{ url('mediciones?filter=custom&start_date=') }}${startDate}&end_date=${endDate}`;
    });

    // Marcar el botón activo al cargar la página
    const urlParams = new URLSearchParams(window.location.search);
    const filter = urlParams.get('filter');
    if (filter === 'last7days') {
        recentDataBtn.addClass('active');
    } else if (filter === 'custom') {
        customRangeBtn.addClass('active');
    }

    function initDateFilters() {
    try {
        const availableMonths = {!! json_encode($availableMonths) !!};
        const availableYears = {!! json_encode($availableYears) !!};
        const currentMonth = new Date().getMonth() + 1;
        const currentYear = new Date().getFullYear();

        const startMonthSelect = $('#startMonth'); // Asegúrate de que el select tenga el ID "startMonth"
        const endMonthSelect = $('#endMonth');     // Asegúrate de que el select tenga el ID "endMonth"
        const startYearSelect = $('#startYear');   // Asegúrate de que el select tenga el ID "startYear"
        const endYearSelect = $('#endYear');     // Asegúrate de que el select tenga el ID "endYear"

        const monthNames = {
            1: 'Enero', 2: 'Febrero', 3: 'Marzo', 4: 'Abril', 5: 'Mayo', 6: 'Junio',
            7: 'Julio', 8: 'Agosto', 9: 'Septiembre', 10: 'Octubre', 11: 'Noviembre', 12: 'Diciembre'
        };

        startMonthSelect.empty();
        endMonthSelect.empty();
        startYearSelect.empty();
        endYearSelect.empty();

        $.each(availableMonths, function(index, month) {
            startMonthSelect.append($('<option>', {
                value: month,
                text: monthNames[month]
            }));
            endMonthSelect.append($('<option>', {
                value: month,
                text: monthNames[month]
            }));
        });

        $.each(availableYears, function(index, year) {
            startYearSelect.append($('<option>', {
                value: year,
                text: year
            }));
            endYearSelect.append($('<option>', {
                value: year,
                text: year
            }));
        });

        startMonthSelect.val(currentMonth);
        endMonthSelect.val(currentMonth);
        startYearSelect.val(currentYear);
        endYearSelect.val(currentYear);

    } catch (error) {
        console.error('Error inicializando filtros:', error);
    }
}

    initDateFilters();

});
</script>

@endsection