<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function successResponseWithData($data = null, $message = null, $status = null)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ]);
    }
    protected function errorResponse($data = null, $message = null, $status = null)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ]);
    }
    protected function errorResponseForDelete($message = null, $status = null)
    {
        return response()->json([

            'message' => $message,
            'status' => $status,
        ]);
    }
    protected function authErrorResponse($message, $status)
    {
        return response()->json([
            'message' => $message,
            'status' => $status,
        ]);
    }
}
