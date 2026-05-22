<?php

namespace App\Models;

class TipoUsuario extends BaseModel
{
    protected $table = 'tipousuarios';

    protected $fillable = [
        'nombre',
        'permisos',
        'activo',
        'eliminado'
    ];

    protected $casts = [
        'permisos' => 'array'
    ];
}