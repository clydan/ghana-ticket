<?php

namespace App\Actions\Auth;

use App\Http\Resources\UserResource;
use Hash;
use App\Models\User;

class RegisterNewUserAction
{
    public function execute()
    {
        // TODO: Use db transaction when storing into the business model
        // TODO: Store role when roles is implemented

        $data = [
            'email' => request()->email,
            'name' => request()->name,
            'password' => Hash::make(request()->password),
        ];

        $newUserRecord = User::create($data);

        $newUserRecord->refresh();

        return response()->json([
            'status' => 200,
            'data' => new UserResource($newUserRecord),
            'message' => 'User successfully registered.'
        ]);
    }
}