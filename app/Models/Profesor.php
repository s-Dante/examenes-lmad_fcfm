<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\Materia;
use App\Models\PlanDeEstudio;
use App\Models\ProgramaDeEstudio;
use App\Models\Dependencia;

class Profesor extends Model
{
    /** @use HasFactory<\Database\Factories\ProfesorFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_profesores';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'correo_electronico',
        'numero_empleado',
        'estatus',
    ];

    protected $casts = [
        'estatus' => 'boolean',
    ];


    /**
     * Obtener el nombre completo
     */
    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}"),
        );
    }


    // RELACIONES
    
    /**
     * Un profesor puede estar asignado a muchos grupos
     */
    public function grupos(): HasMany
    {
        return $this->hasMany(Grupo::class, 'profesor_id');
    }

    /**
     * Filtrar los grupos por materia
     */
    public function gruposDeMateria(int $materiaId): HasMany 
    {
        return $this->grupos()->where('materia_id', $materiaId);
    }
}
