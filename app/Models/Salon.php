<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salon extends Model
{
    /** @use HasFactory<\Database\Factories\SalonFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tbl_salones';

    protected $fillable = [
        'nombre',
        'capacidad',
        'estatus',
    ];

    protected $casts = [
        'estatus' => 'boolean',
        'capacidad' => 'integer',
    ];
}
