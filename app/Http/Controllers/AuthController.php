<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! Auth::attempt($credentials)) {
            return ApiResponse::unauthorized('Credenciais inválidas');
        }

        $user = Auth::user();

        $token = $user->createToken($user->name, ['clients:list', 'clients:detail'], now()->addHour())->plainTextToken;

        return ApiResponse::success([
            'user' => $user->name,
            'email' => $user->email,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ApiResponse::success('Logout realizado com sucesso');
    }
}
