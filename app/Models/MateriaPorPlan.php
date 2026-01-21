<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriaPorPlan extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaPorPlanFactory> */
    use HasFactory;
    use SoftDeletes;

    public $incrementing = true;

    protected $table = 'tbl_materias_por_planes_academicos';

    protected $fillable = [
        'plan_academico_id',
        'materia_id',
        'semestre',
        'creditos',
    ];

    protected $casts = [
        'plan_academico_id' => 'integer',
        'materia_id' => 'integer',
        'semestre' => 'integer',
        'creditos' => 'integer',
    ];

    /**
     * Datos de la materia
     */
    public function getDescripcionCompletaAttribute(): string
    {
        return "Semestre {$this->semestre} - {$this->creditos} Créditos";
    }
}
