<?php

namespace App\Models;

class Usuario extends BaseAuthenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'password',
        'idEmpleado',
        'idTipoUsuario',
        'permisos',
        'foto',
        'activo',
        'eliminado'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'permisos' => 'array'
    ];

    protected $appends = [
        'tipoUsuario',
        'permisosFinales'
    ];

    public function getTipoUsuarioAttribute()
    {
        return TipoUsuario::find($this->idTipoUsuario);
    }

    public function getPermisosFinalesAttribute()
    {
        if ($this->id == 1) {

            return [
                'superAdministrador' => true
            ];

        }

        $tipoPermisos = $this->tipoUsuario?->permisos ?? [];

        $usuarioPermisos = $this->permisos ?? [];

        return array_merge_recursive(
            $tipoPermisos,
            $usuarioPermisos
        );
    }
}