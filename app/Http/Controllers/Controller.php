<?php
namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Handle success response
     */
    protected function success($data = null, string $message = '', int $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'payload' => $data,
        ], $status);
    }
    
    /**
     * Handle error response with optional error data
     */
    protected function error(string $message = 'An error occurred', int $status = 400, $errors = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'payload' => null,
        ];
        
        if ($errors !== null) {
            $response['errors'] = $errors;
        }
        
        return response()->json($response, $status);
    }
}