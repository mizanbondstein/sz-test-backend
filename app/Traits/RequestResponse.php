<?php

namespace App\Traits;

trait RequestResponse
{
    public function successResponse($message, $data = [])
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], 200);
    }
    public function errorResponse($message, $data = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], 500);
    }
    public function failedResponse($errors)
    {
        return response()->json([
            'status' => false,
            'message' => 'Validation failed!',
            'data' => [
                'errors' =>  $errors
            ]
        ], 422);
    }

}
