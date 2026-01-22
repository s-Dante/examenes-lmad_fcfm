<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConsultaController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Ruta para la consulta de exámenes
Route::get('/', [ConsultaController::class, 'index'])->name('inicio');