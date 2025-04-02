<?php

use App\Http\Controllers\PlantallaPrincipalController;
use App\Http\Controllers\EstadisticaController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return redirect('/mediciones'); // Redirige a la lista de proyectos
});

Route::resource('mediciones', PlantallaPrincipalController::class);

Route::get('/estadisticas', [EstadisticaController::class, 'index'])
    ->name('estadistica');