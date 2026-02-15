<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GeneralExceptionHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AdminLoginRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            throw_if(
                ! $user->hasRole('admin'),
                new GeneralExceptionHandler('Unauthorized', 403)
            );

            return response()->json([
                'status' => 200,
                'data' => new AuthUserResource($user),
                'message' => 'Login successful',
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
