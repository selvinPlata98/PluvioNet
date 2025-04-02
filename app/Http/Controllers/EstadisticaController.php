<?php

namespace App\Http\Controllers;
use App\Models\Pluviometro;

use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    //
    public function index()
    {
        $datos = Pluviometro::all();
        return view('estadistica',data: compact('datos'));
        //pantalla de inicio //, data: compact('datos','usuario'),
       
    }
}
