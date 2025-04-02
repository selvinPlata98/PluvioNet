<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pluviometro;

class PlantallaPrincipalController extends Controller
{
    //
   

    public function index()
    {
        $datos = Pluviometro::paginate(10); // Cambia el 10 por el número de items por página
        return view('mediciones.resultados', compact('datos'));
        //pantalla de inicio
    }

   
}
