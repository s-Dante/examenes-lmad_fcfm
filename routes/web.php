<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConsultaController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Ruta Principal (La vista que acabamos de maquetar)
Route::get('/', [ConsultaController::class, 'index'])->name('consulta.index');

// --- Rutas AJAX para los Selects Dinámicos ---
// Obtener semestres disponibles para una carrera (programa)
Route::get('/ajax/semestres/{programa_id}', [ConsultaController::class, 'getSemestres']);
// Obtener materias para una carrera y semestre específico
Route::get('/ajax/materias/{programa_id}/{semestre}', [ConsultaController::class, 'getMaterias']);