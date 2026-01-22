<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\ProgramaAcademico;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConsultaController extends Controller
{
    public function index(Request $request): View
    {
        $busqueda = $request->input('q');
        $carreraId = $request->input('carrera');

        $query = Examen::with([
            'grupo.materia', 
            'grupo.profesor', 
            'salon', 
            'grupo.periodoAcademico'
        ])
        ->where('estatus', true);

        if ($busqueda) {
            $query->whereHas('grupo', function ($q) use ($busqueda) {
                $q->whereHas('materia', function ($m) use ($busqueda) {
                    $m->where('nombre', 'like', "%{$busqueda}%")
                      ->orWhere('codigo', 'like', "%{$busqueda}%");
                })
                ->orWhere('nombre', 'like', "%{$busqueda}%");
            });
        }



        // 4. Ordenar por fecha (los más próximos primero)
        $examenes = $query->orderBy('fecha_hora', 'asc')->paginate(10);

        return view('welcome', compact('examenes', 'busqueda'));
    }
}