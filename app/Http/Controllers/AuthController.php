<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\ApiResponse;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
        if (!Auth::guard('web')->attempt($credentials)) {
            return ApiResponse::unauthorized('Credenciais inválidas');
        }

        $user = Auth::guard('web')->user();

        // Assume o tempo de expiração que está configurado no Sanctum
        $token = $user->createToken($user->name, ['*'], now()->addHour())->plainTextToken;    
        return ApiResponse::success([
            'user' => $user->name,
            'email' => $user->email,
            'token' => $token
        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();   
        return ApiResponse::success('Logout realizado com sucesso');
    }
}