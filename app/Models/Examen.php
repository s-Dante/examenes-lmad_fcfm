<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Enums\TipoExamen;

class Examen extends Model
{
    /** @use HasFactory<\Database\Factories\ExamenFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_examenes';

    protected $fillable = [
        'tipo',
        'fecha_hora',
        'estatus',
        'grupo_id',
        'salon_id',
        'creado_por_id',
    ];

    protected $casts = [
        'tipo' => TipoExamen::class,
        'fecha_hora' => 'datetime',
        'estatus' => 'boolean',
        'grupo_id' => 'integer',
        'salon_id' => 'integer',
        'creado_por_id' => 'integer',
    ];


    // Relaciones

    /**
     * Un examen pertenece a un grupo
     */
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    /**
     * Un examen tiene un salon
     */
    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class, 'salon_id');
    }

    /**
     * Un examen fue creado por un usuario
     */
    public function creadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creado_por_id');
    }
}
