<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\MeAction;
use App\Actions\Auth\RegisterNewUserAction;
use App\Exceptions\SystemBadRequestException;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Http\Request;
use LogoutAction;

class AuthController extends Controller
{
    public function login(Request $request, LoginAction $action)
    {
        $loginCredentials = $request->only('email', 'password');

        return $action->execute($loginCredentials);
    }

    public function logout(LogoutAction $action)
    {
        return $action->execute();
    }

    public function me(MeAction $action)
    {
        return $action->execute();
    }

    public function register(UserRegistrationRequest $request, RegisterNewUserAction $action)
    {
        return $action->execute();
    }
}
