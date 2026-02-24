<?php

namespace App\Actions\User;

use App\Http\Resources\AccountTypeResource;
use App\Models\AccountType;

class GetAccountType
{
    public function execute()
    {
        $accountTypes = AccountType::get();

        return response()->json([
            'status' => 200,
            'data' => AccountTypeResource::collection($accountTypes),
            'message' => 'Account types retrieved successfully.'
        ]);
    }
}