<?php

namespace App\Models;

class Opcion extends BaseModel
{
    protected $table = 'opciones';

    protected $fillable = [
        'idModulo',
        'nombre',
        'ruta',
        'icono',
        'color',
        'activo',
        'eliminado'
    ];

    protected $appends = [
        'modulo'
    ];

    public function getModuloAttribute()
    {
        return Modulo::find($this->idModulo);
    }
}