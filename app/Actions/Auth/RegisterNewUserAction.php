<?php

namespace App\Actions\Auth;

use App\Actions\Business\RegisterNewBusiness;
use App\DTOs\RegisterBusinessDto;
use App\Http\Resources\UserResource;
use Arr;
use DB;
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

        DB::transaction(function () use ($data) {
            // TODO: add more checks to make sure that same data is not being stored twice.
            $newUserRecord = User::updateOrCreate(
                ['email' => Arr::get($data, 'email')],
                $data
            );

            $newUserRecord->refresh();

            $businessInfoDto = $this->prepDto($newUserRecord);

            $newBusiness = (new RegisterNewBusiness())->execute($businessInfoDto);

            if ($newBusiness === false) {
                throw new \Exception('Business registration failed');
            }

        });

        return response()->json([
            'status' => 200,
            'data' => null,
            'message' => 'User successfully registered.'
        ]);
    }

    private function prepDto($user): RegisterBusinessDto
    {
        $data = [
            'businessName' => request()->business_name,
            'businessAddress' => request()->business_address,
            'businessCity' => request()->business_city,
            'businessEmail' => request()->business_email,
            'user' => $user,
        ];

        return RegisterBusinessDto::from($data);
    }
}