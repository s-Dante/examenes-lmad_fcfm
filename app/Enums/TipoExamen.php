<?php

declare(strict_types=1);

namespace App\Enums;

enum TipoExamen: string
{
    case PARCIAL_1 = 'parcial_1';
    case PARCIAL_2 = 'parcial_2';
    case PARCIAL_3 = 'parcial_3';
    case PARCIAL_4 = 'parcial_4';
    case ORDINARIO = 'ordinario';
    case EXTRAORDINARIO = 'extraordinario';

    // Helper para mostrar texto bonito en el Frontend
    public function label(): string
    {
        return match($this) {
            self::PARCIAL_1 => '1er Parcial',
            self::PARCIAL_2 => '2do Parcial',
            self::PARCIAL_3 => '3er Parcial',
            self::PARCIAL_4 => '4to Parcial',
            self::ORDINARIO => 'Ordinario (Final)',
            self::EXTRAORDINARIO => 'Extraordinario (2da Oportunidad)',
        };
    }
}