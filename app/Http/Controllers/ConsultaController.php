<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


use App\Models\ProgramaAcademico;
use App\Models\PlanAcademico;

class ConsultaController extends Controller
{
    /**
     * Muestra la vista principal de consulta.
     */
    public function index()
    {
        // Solo carreras activas
        $carreras = ProgramaAcademico::where('estatus', true)->get();
        return view('consulta.index', compact('carreras'));
    }

    /**
     * AJAX: Obtiene los semestres disponibles para el plan activo de una carrera.
     */
    public function getSemestres($programa_id): JsonResponse
    {
        // 1. Buscamos el plan activo de esa carrera
        $planActivo = PlanAcademico::where('programa_academico_id', $programa_id)
                        ->where('estatus', true)
                        ->first();

        if (!$planActivo) {
            return response()->json([], 404); // No hay plan activo
        }

        // 2. Obtenemos los semestres distintos desde la tabla pivote
        // Usamos la relación 'materias()' que definiste en el modelo PlanAcademico
        // pero consultamos directamente sobre la tabla pivote para ser más eficientes.
        $semestres = DB::table('tbl_materias_por_planes_academicos')
                        ->where('plan_academico_id', $planActivo->id)
                        ->select('semestre')
                        ->distinct()
                        ->orderBy('semestre', 'asc')
                        ->pluck('semestre'); // Devuelve array simple: [1, 2, 3...]

        return response()->json($semestres);
    }

    /**
     * AJAX: Obtiene las materias de un semestre específico del plan activo.
     */
    public function getMaterias($programa_id, $semestre): JsonResponse
    {
        $planActivo = PlanAcademico::where('programa_academico_id', $programa_id)
                        ->where('estatus', true)
                        ->first();

        if (!$planActivo) {
            return response()->json([], 404);
        }

        // Obtenemos las materias filtradas por semestre usando la relación BelongsToMany
        $materias = $planActivo->materias()
                        ->wherePivot('semestre', $semestre)
                        ->where('tbl_materias.estatus', true) // Asegurar que la materia esté activa
                        ->orderBy('nombre', 'asc')
                        ->get(['tbl_materias.id', 'tbl_materias.nombre']);

        return response()->json($materias);
    }
}