<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data): JsonResponse
    {
        return response()->json([
            'status_code' => 200,
            'message' => 'Success',
            'data' => $data,
        ], 200);
    }

    public static function error($message, $statusCode = 500): JsonResponse
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }

    public static function unauthorized($message): JsonResponse
    {
        return response()->json([
            'status_code' => 401,
            'message' => $message,
        ], 401);
    }
}
