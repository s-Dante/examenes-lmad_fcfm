<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\PlanAcademico;
use App\Models\MateriaPorPlan;

class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_materias';

    protected $fillable = [
        'nombre',
        'codigo',
        'estatus',
    ];

    protected $casts = [
        'estatus' => 'boolean',
    ];

    /**
     * Una materia pertenece a un plan academico.
     */
    public function planesDeEstudio(): BelongsToMany
    {
        return $this->belongsToMany(PlanAcademico::class, 'tbl_materias_por_planes_academicos', 'materia_id', 'plan_academico_id')
                    ->using(MateriaPorPlan::class)
                    ->withPivot(['semestre', 'creditos', 'id'])
                    ->withTimestamps();
    }

}
