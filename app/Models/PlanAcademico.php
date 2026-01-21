<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\ProgramaAcademico;
use App\Models\Materia;
use App\Models\MateriaPorPlan;

class PlanAcademico extends Model
{
    /** @use HasFactory<\Database\Factories\PlanAcademicoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_planes_academicos';

    protected $fillable = [
        'nombre',
        'codigo',
        'estatus',
        'programa_academico_id',
    ];

    protected $casts = [
        'estatus' => 'boolean',
        'programa_academico_id' => 'integer',
    ];

    /**
     * Un plan academico pertenece a un programa academico.
     */
    public function programaAcademico(): BelongsTo
    {
        return $this->belongsTo(ProgramaAcademico::class, 'programa_academico_id');
    }

    /**
     * Un plan academico puede tener muchas materias
     */
    public function materias(): BelongsToMany
    {
        return $this->belongsToMany(
            Materia::class,
            'tbl_materias_por_planes_academicos',
            'plan_academico_id',
            'materia_id'
        )
        ->withPivot(['semestre', 'creditos'])
        ->withTimestamps();
    }
}
