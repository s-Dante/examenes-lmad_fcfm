<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PeriodoAcademico extends Model
{
    /** @use HasFactory<\Database\Factories\PeriodoAcademicoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_periodos_academicos';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'estatus',
    ];

    protected $casts = [
        'estatus' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    /**
     * Obtener el período académico en formato de cadena legible.
     */
    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->nombre} ({$this->fecha_inicio->format('d/m/Y')} - {$this->fecha_fin->format('d/m/Y')})",
        );
    }
}
