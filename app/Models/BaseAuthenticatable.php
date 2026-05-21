<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseAuthenticatable extends Authenticatable
{
    protected $casts = [
        'activo' => 'boolean',
        'eliminado' => 'boolean'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {

            if (!isset($model->activo)) {
                $model->activo = 1;
            }

            if (!isset($model->eliminado)) {
                $model->eliminado = 0;
            }

        });

        static::addGlobalScope('noEliminados', function ($query) {
            $query->where('eliminado', 0);
        });
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', 1);
    }

    public function scopeInactivos($query)
    {
        return $query->where('activo', 0);
    }

    public function scopeEliminados($query)
    {
        return $query->withoutGlobalScope('noEliminados')
            ->where('eliminado', 1);
    }

    public function scopeSinEliminados($query)
    {
        return $query->withoutGlobalScope('noEliminados');
    }

    public function eliminar()
    {
        $this->eliminado = 1;
        $this->save();
    }

    public function activar()
    {
        $this->activo = 1;
        $this->save();
    }

    public function desactivar()
    {
        $this->activo = 0;
        $this->save();
    }

    public function estaActivo()
    {
        return $this->activo == 1;
    }

    public function estaEliminado()
    {
        return $this->eliminado == 1;
    }
}