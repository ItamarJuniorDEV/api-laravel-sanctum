<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function() {
    return ApiResponse::success('API rodando');
})->middleware('auth:sanctum');

Route::apiResource('clients', ClientController::class)->middleware('auth:sanctum');
// Route::get('clients', [ClientController::class, 'index'])->middleware(['auth:sanctum', 'abilities:clients:list']);
// Route::post('clients', [ClientController::class, 'store'])->middleware(['auth:sanctum', 'abilities:clients:detail']);
// Route::get('clients/{id}', [ClientController::class, 'show']);
// Route::put('clients/{id}', [ClientController::class, 'update']);
// Route::delete('clients/{id}', [ClientController::class, 'destroy']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');;