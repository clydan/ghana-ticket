<?php

namespace App\Actions\Business;

use App\Exceptions\GeneralExceptionHandler;
use Auth;
use App\DTOs\RegisterBusinessDto;

class CreateBusinessAction
{
    public function execute()
    {
        $user = Auth::user();

        $businessInfoDto = $this->prepDto($user);

        $newBusiness = (new RegisterNewBusiness())->execute($businessInfoDto);

        if (blank($newBusiness)) {
            throw new GeneralExceptionHandler('Business registration failed');
        }

        return response()->json([
            'status' => 200,
            'data' => null,
            'message' => 'Business types retrieved successfully.'
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