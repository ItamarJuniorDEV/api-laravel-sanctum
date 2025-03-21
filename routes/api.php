<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function() {
    return ApiResponse::success('API rodando');
});

Route::apiResource('clients', ClientController::class);

Route::post('login', [AuthController::class, 'login']);