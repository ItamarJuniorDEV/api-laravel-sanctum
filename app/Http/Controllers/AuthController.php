<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
            return response()->json([
                'error' => 'Não autorizado!',
            ], 401);
        }

        $user = Auth::guard('web')->user();
        $token = $user->createToken($user->name)->plainTextToken;
    
        return response()->json([
            'token' => $token
        ]);
    }
}