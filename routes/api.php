<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function() {
    return response()->json(
    [
        'status' => 'ok',
        'message' => 'API rodando!'
    ],
    200
    
    );
});

Route::apiResource('clients', ClientController::class);