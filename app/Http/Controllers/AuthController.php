<?php

namespace App\Http\Controllers;

use App\Actions\Auth\RegisterNewUserAction;
use App\Exceptions\SystemBadRequestException;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginCredentials = $request->only('email', 'password');

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

    public function logout()
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

    public function me()
    {
        $user = Auth::user();

        return response()->json([
            'status' => 200,
            'data' => new UserResource($user),
            'message' => 'User resource retrieved successfully',
        ]);
    }

    public function register(UserRegistrationRequest $request, RegisterNewUserAction $action)
    {
        $data = $request->all();

        return $action->execute();
    }
}
