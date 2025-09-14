<?php

use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public function execute()
    {
        $user = Auth::user();
        $currentAccessToken = $user->currentAccessToken();
        $currentAccessToken->expires_at = now();
        $currentAccessToken->save();

        return response()->json([
            'status' => 200,
            'data' => null,
            'message' => 'Logged out successfully.'
        ]);
    }
}