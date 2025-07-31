<?php

namespace App\Exceptions;

use Exception;

class SystemBadRequestException extends Exception
{
    public function __construct($message, protected array $data = [], $status = null)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function render()
    {
        return response()->json([
            'status' => $this->status ?? 400,
            'data' => $this->data,
            'message' => $this->message,
        ]);
    }
}
