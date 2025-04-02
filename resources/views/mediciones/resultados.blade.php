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
    }
    
    .table-card {
        background-color: var(--dark-gray);
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }
    
    .table-title {
        color: white;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }
    
    .custom-table {
        color: white;
        margin-bottom: 0;
    }
    
    .custom-table thead {
        background-color: var(--medium-gray);
        color: white;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
    }
    
    .custom-table tbody tr {
        background-color: var(--dark-gray);
        border-bottom: 1px solid var(--light-gray);
    }
    
    .custom-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .custom-table tbody tr:hover {
        background-color: var(--medium-gray);
    }
    
    .badge-sensor {
        background-color: var(--light-gray);
        color: white;
        font-weight: 500;
    }
    
    .map-link {
        color: var(--blue-accent);
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .map-link:hover {
        color: #ebf8ff;
        text-decoration: none;
    }
    
    .rain-high {
        color: var(--red-accent);
        font-weight: 600;
    }
    
    .rain-low {
        color: var(--green-accent);
        font-weight: 600;
    }
    
    .secondary-text {
        color: var(--lighter-gray);
    }
    
    .table-footer {
        background-color: var(--medium-gray);
        border-top: 1px solid var(--light-gray);
    }
    
    .export-btn {
        background-color: var(--blue-accent);
        border: none;
        transition: all 0.3s;
    }
    
    .export-btn:hover {
        background-color: #3182ce;
        transform: translateY(-1px);
    }
    .pagination {
    --bs-pagination-border-width: 1px;
    --bs-pagination-font-size: 1.1rem;
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
}

.page-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.page-item.active .page-link {
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.page-item.disabled .page-link {
    opacity: 0.6;
}
</style>

<div class="container py-5">
    <h2 class="text-center mb-4 table-title">
        <i class="mdi mdi-weather-hail  me-2"></i> Registros de Pluviómetros
    </h2>
    
    <div class="table-card">
        <div class="table-responsive-lg">
            <table class="table custom-table table-hover">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Sensor</th>
                        <th>Usuario</th>
                        <th>Lluvia (mm)</th>
                        <th>Ubicación</th>
                        <th class="pe-4">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $dato)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $dato->id }}</td>
                        <td>
                            <span class="badge badge-sensor rounded-pill px-3 py-2">
                                <i class="bi bi-tools me-1"></i>{{ $dato->nombre_sensor }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <span class="badge bg-gray-700 rounded-pill px-3 py-2">
                                <i class="bi bi-person-fill me-1"></i>#{{ $dato->id_usuario }}
                            </span>
                        </td>
                        <td class="{{ $dato->cantidad_lluvia > 10 ? 'rain-high' : 'rain-low' }}">
                            {{ $dato->cantidad_lluvia }} mm
                            @if($dato->cantidad_lluvia > 10)
                            <i class="bi bi-exclamation-triangle-fill ms-2"></i>
                            @endif
                        </td>
                        <td>
                            <a href="https://maps.google.com?q={{ $dato->latitude }},{{ $dato->longitude }}" 
                               target="_blank" 
                               class="map-link">
                                <i class="bi bi-geo-alt-fill me-2"></i>Mapa
                            </a>
                        </td>
                        <td class="pe-4 secondary-text">
                            {{ $dato->created_at->format('d/m/Y H:i') }}
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
function exportToCSV() {
    // Obtener los datos de la tabla
    const data = @json($datos);
    
    // Mostrar estado de carga
    const btn = event.target;
    const originalHtml = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-arrow-clockwise me-2"></i>Generando...';
    btn.disabled = true;
    
    // Definir encabezados
    const headers = [
        'ID',
        'Sensor',
        'Usuario',
        'Cantidad de Lluvia (mm)',
        'Latitud',
        'Longitud',
        'Fecha Registro'
    ];
    
    // Mapear los datos al formato CSV
    const csvRows = [];
    
    // Añadir encabezados
    csvRows.push(headers.join(','));
    
    // Añadir filas de datos
    data.forEach(item => {
        const row = [
            item.id,
            `"${item.nombre_sensor}"`, // Entre comillas por si contiene comas
            item.id_usuario,
            item.cantidad_lluvia,
            item.latitude,
            item.longitude,
            `"${new Date(item.created_at).toLocaleString()}"`
        ];
        csvRows.push(row.join(','));
    });
    
    // Crear el contenido CSV
    const csvContent = csvRows.join('\n');
    
    // Crear el archivo y descargarlo
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', `pluviometros_${new Date().toISOString().slice(0,10)}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Restaurar el botón
    btn.innerHTML = originalHtml;
    btn.disabled = false;
}
</script>
@endsection