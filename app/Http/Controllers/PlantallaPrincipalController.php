<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datos;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlantallaPrincipalController extends Controller
{
   public function index(Request $request)
{
    $query = DB::connection('pgsql')->table('datos')->orderBy('created_at', 'desc');
    $filterApplied = 'todos los registros';

    // Filtro para últimos 7 días
    if ($request->filter === 'last7days') {
        $query->where('created_at', '>=', now()->subDays(7));
        $filterApplied = 'últimos 7 días';
    }
    
    // Filtro para rango personalizado
    if ($request->filter === 'custom' && $request->start_date && $request->end_date) {
        try {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            
            $query->whereBetween('created_at', [$startDate, $endDate]);
            
            // Mejorar el mensaje del filtro aplicado
            $filterApplied = sprintf(
                "del %s al %s",
                $startDate->format('d/m/Y'),
                $endDate->format('d/m/Y')
            );
            
        } catch (\Exception $e) {
            // Manejar error en formato de fecha
            return back()->with('error', 'Formato de fecha inválido');
        }
    }

    // Obtener datos paginados
    $datos = $query->paginate(10);
    
    // Obtener años y meses disponibles
    $availableDates = DB::connection('pgsql')
        ->table('datos')
        ->select(
            DB::raw('EXTRACT(YEAR FROM created_at) as year'),
            DB::raw('EXTRACT(MONTH FROM created_at) as month')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

    $availableYears = $availableDates->pluck('year')->unique()->values();
    $availableMonths = $availableDates->pluck('month')->unique()->values();
    
    return view('mediciones.resultados', compact(
        'datos', 
        'filterApplied', 
        'availableYears', 
        'availableMonths'
    ));
}
}