@extends('layout/plantilla')

@section('tituloPagina', 'Estadísticas de Pluviómetros')

@section('contenido')

<style>
    /* Fondo gris uniforme para todo el contenedor */
    .container.py-2 {
        background-color: #e0e0e0; /* Gris más claro */
        border-radius: 10px;
        padding: 30px;
        margin-top: 30px;
    }

    /* Estilo para la tabla con fondo gris */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background-color: transparent;
    }

    .custom-table tr td:first-child {
        font-weight: 600;
        width: 30%;
        background-color: #d5d5d5; /* Gris un poco más oscuro */
        color: #333;
        border-right: 1px solid #bdbdbd;
    }

    .custom-table tr td {
        padding: 15px 20px;
        border-bottom: 1px solid #bdbdbd;
        vertical-align: middle;
        background-color: #e8e8e8; /* Gris muy claro */
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    .custom-table tr:hover td {
        background-color: #d0d0d0; /* Gris para hover */
    }

    /* Contenedor del pluviómetro con fondo gris */
    #pluviometro-estado {
        border-radius: 8px;
        background: #d5d5d5; /* Gris para el contenedor */
        overflow: hidden;
        position: relative;
        height: 250px;
        border: 1px solid #b0b0b0;
    }

    /* Efecto de agua */
    #agua-nivel {
        transition: all 1.5s cubic-bezier(0.19, 1, 0.22, 1);
        background: linear-gradient(to top, #1565c0, #42a5f5);
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        display: flex;
        align-items: flex-end;
        justify-content: center;
    }

    /* Títulos con fondo gris */
    .table-title {
        color: #212121;
        font-size: 1.5rem;
        margin-bottom: 25px;
        font-weight: 600;
        background-color: #d5d5d5;
        padding: 10px 25px;
        border-radius: 30px;
        display: inline-block;
        border: 1px solid #b0b0b0;
    }

    /* Escala de medición */
    .escala {
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 30px;
        border-right: 1px solid #b0b0b0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .marca-escala {
        position: relative;
        height: 1px;
        background: #888;
        width: 10px;
        margin-left: 20px;
    }

    .marca-escala::after {
        content: attr(data-value);
        position: absolute;
        left: -25px;
        top: -8px;
        font-size: 10px;
        color: #333;
    }

    /* Indicador de nivel */
    .nivel-indicador {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.9);
        padding: 5px 10px;
        border-radius: 15px;
        font-weight: bold;
        color: #1565c0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>

<div class="main-panel" style="display: flex; justify-content: center;">
    <div class="col-lg-12 grid-margin stretch-card" style="max-width: 1000px;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Cantidad de Lluvia por Fecha</h4>
                <canvas id="rainChart" style="height:400px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rainData = @json($rainData);

    // Verificar si rainData está vacío o no está definido
    if (!rainData || rainData.length === 0) {
        console.error("No hay datos para mostrar en el gráfico.");
        document.getElementById('rainChart').innerHTML = "<p>No hay datos disponibles.</p>"; // Mostrar un mensaje en el canvas
        return; // Detener la ejecución del script
    }

    const chartColors = {
        blue: 'rgba(54, 162, 235, 0.7)'
    };

    new Chart(
        document.getElementById('rainChart').getContext('2d'),
        {
            type: 'line',
            data: {
                labels: rainData.map(item => {
                    const date = new Date(item.created_at);
                    return date.toLocaleDateString(); // Formatea la fecha sin la hora
                }),
                datasets: [{
                    label: 'Cantidad de Lluvia (mm)',
                    data: rainData.map(item => item.cantidad_lluvia),
                    backgroundColor: chartColors.blue.replace('0.7', '0.3)'),
                    borderColor: chartColors.blue,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad de Lluvia (mm)'
                        }
                    }
                }
            }
        }
    );
});
</script>

<div class=" py-2 d-flex flex-column align-items-center">
    <!-- Sección Último Registro -->
    <h2 class="text-center mb-4 table-title">
        <i class="mdi mdi-information-outline me-2"></i> Último Registro
    </h2>

    @if($ultimoDato)
    <div style="width: 90%;">
        <table class="table custom-table">
            <tbody>
                <tr>
                    <td><i class="mdi mdi-identifier me-2"></i> ID</td>
                    <td>#{{ str_pad($ultimoDato->id, 5, '0', STR_PAD_LEFT) }}</td>
                </tr>
               
                <tr>
                    <td><i class="mdi mdi-weather-rainy me-2"></i> Lluvia</td>
                    <td>
                        <span style="color: #1565c0; font-weight: bold;">
                            {{ $ultimoDato->cantidad_lluvia, 2 }} 
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><i class="mdi mdi-clock me-2"></i> Fecha</td>
                    <td>
                        <span style="color: #424242;">
                            {{ $ultimoDato->created_at->format('d/m/Y H:i:s') }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @else
    <div style="width: 90%; color: #424242; background-color: #d5d5d5; padding: 15px; border-radius: 5px; border: 1px solid #b0b0b0;">
        <i class="mdi mdi-alert-circle-outline me-2"></i> No hay datos disponibles
    </div>
    @endif

    <!-- Sección Nivel de Agua -->
    <h2 class="text-center mt-5 mb-4 table-title">
        <i class="mdi mdi-water me-2"></i> Nivel de Agua Actual
    </h2>

    <div style="width: 90%; margin-top: 20px;">
        <div id="pluviometro-estado">
            <!-- Escala de medición -->
            <div class="escala">
                <div class="marca-escala" data-value="50mm" style="top: 10%;"></div>
                <div class="marca-escala" data-value="40mm" style="top: 30%;"></div>
                <div class="marca-escala" data-value="30mm" style="top: 50%;"></div>
                <div class="marca-escala" data-value="20mm" style="top: 70%;"></div>
                <div class="marca-escala" data-value="10mm" style="top: 90%;"></div>
            </div>
            <div id="agua-nivel">
                <div class="nivel-indicador" id="nivel-texto">0 mm</div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ultimoDato = @json($ultimoDato);

    if (ultimoDato) {
        const cantidadLluvia = parseFloat(ultimoDato.cantidad_lluvia);
        const aguaNivel = document.getElementById('agua-nivel');
        const nivelTexto = document.getElementById('nivel-texto');
        
        // Configuración de la visualización
        const maxAltura = 220; // Altura máxima en px
        const maxLluvia = 50; // Máximo valor de lluvia esperado en mm
        const factorEscala = maxAltura / maxLluvia;
        
        // Calcular altura final (limitada al máximo)
        let alturaFinal = Math.min(cantidadLluvia * factorEscala, maxAltura);
        
        // Efecto de llenado inicial
        aguaNivel.style.height = '0';
        nivelTexto.textContent = '0 mm';
        
        // Animación suave
        setTimeout(() => {
            aguaNivel.style.height = `${alturaFinal}px`;
            
            // Animación del texto
            let current = 0;
            const incremento = cantidadLluvia / 50;
            const intervalo = setInterval(() => {
                current += incremento;
                if (current >= cantidadLluvia) {
                    current = cantidadLluvia;
                    clearInterval(intervalo);
                }
                nivelTexto.textContent = current.toFixed(1) + ' mm';
            }, 20);
            
            // Efecto de olas (opcional)
            aguaNivel.style.background = `
                linear-gradient(
                    to top, 
                    #1565c0, 
                    #1976d2 ${Math.max(0, 100 - alturaFinal/maxAltura*100)}%, 
                    #42a5f5 100%
                )`;
        }, 300);
    } else {
        document.getElementById('pluviometro-estado').innerHTML = `
            <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                <p class="text-muted"><i class="mdi mdi-alert-circle-outline me-2"></i> Sin datos disponibles</p>
            </div>`;
    }
});
</script>
@endsection