<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Materia;
use App\Models\Profesor;
use App\Models\PeriodoAcademico;

class Grupo extends Model
{
    /** @use HasFactory<\Database\Factories\GrupoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_grupos';

    protected $fillable = [
        'nombre',
        'estatus',
        'materia_id',
        'profesor_id',
        'periodo_academico_id',
    ];

    protected $casts = [
        'estatus' => 'boolean',
        'materia_id' => 'integer',
        'profesor_id' => 'integer',
        'periodo_academico_id' => 'integer',
    ];

    /**
     * Un grupo pertenece a una materia.
     */
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    /**
     * Un profesor imparte a un grupo.
     */
    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    /**
     * Un grupo pertenece a un período académico.
     */
    public function periodoAcademico(): BelongsTo
    {
        return $this->belongsTo(PeriodoAcademico::class, 'periodo_academico_id');
    }
}
