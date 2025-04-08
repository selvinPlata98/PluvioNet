<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datos; // Cambiamos Pluviometro por Datos
use Carbon\Carbon;

class EstadisticaController extends Controller
{
    public function index()
    {
        // Obtener todos los datos con fecha y cantidad de lluvia
        $rainData = Datos::select('created_at', 'cantidad_lluvia')
            ->orderBy('created_at')
            ->get();
    
        // Obtener el último dato ingresado
        $ultimoDato = Datos::latest('created_at')->first(); // Usamos latest con columna específica
    
        // Datos para el estado del pluviómetro
        $pluviometroEstado = [
            'estado' => 'Funcionando',
            'ultima_actualizacion' => $ultimoDato ? $ultimoDato->created_at : null,
            'total_registros' => Datos::count(),
        ];
    
        // Datos para la tabla de datos generales
        $datosGenerales = Datos::orderBy('created_at', 'desc')->take(5)->get();
    
        // Calcular la cantidad total de agua
        $cantidadTotalAgua = Datos::sum('cantidad_lluvia');
    
        return view('estadistica', compact(
            'rainData', 
            'pluviometroEstado', 
            'datosGenerales', 
            'cantidadTotalAgua',
            'ultimoDato'
        ));
    }
}