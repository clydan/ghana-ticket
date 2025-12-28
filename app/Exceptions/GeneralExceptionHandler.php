<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Exception;use Illuminate\Http\JsonResponse;

class GeneralExceptionHandler extends Exception
{
     protected int $status;

    public function __construct(
        string $message = 'Something went wrong',
        int $status = 400
    ) {
        parent::__construct($message);
        $this->status = $status;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'success' => $this->status,
            'message' => $this->getMessage(),
        ], $this->status);
    }
}
