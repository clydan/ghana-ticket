<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthUserResource;
use App\Exceptions\SystemBadRequestException;

class LoginAction
{
    public function execute($loginCredentials)
    {
        if (Auth::attempt($loginCredentials)){
            $user = auth()->user();

            return response()->json([
                'status' => 200,
                'data' => new AuthUserResource($user),
                'message' => 'Authentication successful.',
            ]);
        }

       return throw new SystemBadRequestException('Authentication failed. Check email and password.');
    }
}