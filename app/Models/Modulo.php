<?php

namespace App\Models;

class Modulo extends BaseModel
{
    protected $table = 'modulos';

    protected $fillable = [
        'nombre',
        'icono',
        'color',
        'identificador',
        'activo',
        'eliminado'
    ];
}