<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {
            if (! Auth::attempt($credentials)) {
                return ApiResponse::unauthorized('Credenciais inválidas!');
            }

            $user = Auth::user();

            $token = $user->createToken($user->name, ['clients:list', 'clients:detail'], now()->addHour())->plainTextToken;

            return ApiResponse::success([
                'user' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ], 'Login realizado com sucesso!');

        } catch (Throwable $e) {
            report($e);

            return ApiResponse::error('Erro interno no servidor ao tentar fazer login!');
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return ApiResponse::success(null, 'Logout realizado com sucesso!');

        } catch (Throwable $e) {
            report($e);

            return ApiResponse::error('Erro interno no servidor ao tentar fazer logout!');
        }
    }
}
