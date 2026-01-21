<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Enums\RolDeUsuario;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'tbl_usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'llave_acceso',
        'rol',
        'estatus',
        'carrera_id', // Relación con Programa Académico
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'llave_acceso',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'estatus' => 'boolean',
            'rol' => RolDeUsuario::class,
        ];
    }

    // Accesors y Mutators

    /**
     * Nombre completo del usuario
     */
    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}"),
        );
    }


    // Relaciones

    /**
     * Un usuario coordinador pertenece a una carrera
     */
    public function carrera(): BelongsTo
    {
        // Apunta al modelo ProgramaAcademico
        return $this->belongsTo(ProgramaAcademico::class, 'carrera_id');
    }
}
