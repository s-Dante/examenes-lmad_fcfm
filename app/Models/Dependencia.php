<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\ProgramaAcademico;

class Dependencia extends Model
{
    /** @use HasFactory<\Database\Factories\DependenciaFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_dependencias';

    protected $fillable = [
        'nombre',
        'abreviatura',
        'direccion',
        'telefono',
        'email',
        'estatus',
    ];

    protected $casts = [
        'estatus' => 'boolean',
    ];

    /**
     * Una dependencia puede tener muchos programas academicos.
     */
    public function programasAcademicos(): HasMany
    {
        return $this->hasMany(ProgramaAcademico::class, 'dependencia_id');
    }
}
