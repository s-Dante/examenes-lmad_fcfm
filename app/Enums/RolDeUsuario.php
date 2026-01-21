<?php

declare(strict_types=1);

namespace App\Enums;

enum RolDeUsuario: string
{
    case ADMIN = 'admin';
    case COORDINADOR = 'coordinador';
    case ACADEMIAS = 'academias';
    case DIRECTOR = 'director';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrador del Sistema',
            self::COORDINADOR => 'Coordinador de Carrera',
            self::ACADEMIAS => 'Representante de Academias',
            self::DIRECTOR => 'Dirección',
        };
    }
    
    // Helper para verificar permisos
    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }
}