<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciales = [
            'usuario' => $request->usuario,
            'password' => $request->password,
            'activo' => 1
        ];

        if (!$token = Auth::attempt($credenciales)) {

            return response()->json([
                'ok' => false,
                'mensaje' => 'Credenciales incorrectas'
            ], 401);

        }

        $usuario = Auth::user();

        return response()->json([
            'ok' => true,
            'token' => $token,
            'usuario' => $usuario
        ]);
    }

    public function me()
    {
        return response()->json([
            'ok' => true,
            'usuario' => Auth::user()
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'ok' => true
        ]);
    }
}