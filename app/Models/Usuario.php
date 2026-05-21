<?php

namespace App\Models;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Usuario extends BaseAuthenticatable implements JWTSubject
{
    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'password',
        'idEmpleado',
        'idTipoUsuario',
        'foto',
        'activo',
        'eliminado',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password'
    ];

    protected $appends = [
        'tipoUsuario',
        'empleado'
    ];

    protected $casts = [
        'id' => 'integer',
        'idEmpleado' => 'integer',
        'idTipoUsuario' => 'integer',
        'activo' => 'boolean',
        'eliminado' => 'boolean'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getTipoUsuarioAttribute()
    {
        if (!$this->idTipoUsuario) {
            return null;
        }

        $tipoUsuario = TipoUsuario::find($this->idTipoUsuario);

        return $tipoUsuario ? $tipoUsuario->nombre : null;
    }

    public function getEmpleadoAttribute()
    {
        if (!$this->idEmpleado) {
            return null;
        }

        $empleado = Empleado::find($this->idEmpleado);

        return $empleado ? $empleado->nombre : null;
    }

    public function esSuperUsuario()
    {
        return $this->id === 1;
    }
}