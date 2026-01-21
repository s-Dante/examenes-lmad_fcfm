<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Dependencia;
use App\Models\ProgramaEstudio;

class ProgramaAcademico extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramaAcademicoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_programas_academicos';

    protected $fillable = [
        'nombre',
        'abreviatura',
        'descripcion',
        'dependencia_id',
        'estatus',
    ];

    protected $casts = [
        'estatus' => 'boolean',
    ];

    /**
     * Obtiene la dependencia a la que pertenece el programa academico.
     */
    public function dependencia(): BelongsTo
    {
        return $this->belongsTo(Dependencia::class, 'dependencia_id');
    }

    /**
     * Un programa academico puede tener muchos programas de estudio.
     */
    // public function programasEstudio(): HasMany
    // {
    //     return $this->hasMany(ProgramaEstudio::class, 'programa_academico_id');
    // }
}
