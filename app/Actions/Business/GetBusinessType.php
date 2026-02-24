<?php

namespace App\Actions\Business;

use App\Http\Resources\BusinessTypeResource;
use App\Models\BusinessType;

class GetBusinessType
{
    public function execute()
    {
        $businessTypes = BusinessType::get();

        return response()->json([
            'status' => 200,
            'data' => BusinessTypeResource::collection($businessTypes),
            'message' => 'Business types retrieved successfully.'
        ]);
    }
}