<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

trait ApiResponse
{
    public function sendOk($token = null, $status = 'OK', $code = 200): JsonResponse
    {
        if(!$token) {
            Cookie::queue("token", $token, 1440);
        }

        return response()->json([
            'code' => $code,
            'status' => $status
        ], $code);
    }

    public function sendData($token = null, $data, $status = 'OK', $code = 200): JsonResponse
    {
        if(!$token) {
            Cookie::queue("token", $token, 1440);
        }

        return response()->json([
            'code' => $code,
            'status' => $status,
            'data' => $data
        ], $code);
    }

    public function sendError($token = null, $message, $status = 'Error', $code = 400): JsonResponse
    {
        if(!$token) {
            Cookie::queue("token", $token, 1440);
        }

        return response()->json([
            'code' => $code,
            'status' => $status,
            'message' => $message
        ], $code);
    }

    public function handleException(Exception $e): JsonResponse
    {
        Log::error($e);

        if (env('APP_DEBUG')) {
            return $this->sendError($e->getMessage(), 'Error', 500);
        }

        return $this->sendError('Internal Server Error', 'Error', 500);
    }
}
