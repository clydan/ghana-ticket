<?php 

namespace App\Actions\Auth;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class MeAction
{
    public function execute()
    {
        $user = Auth::user();

        return response()->json([
            'status' => 200,
            'data' => new UserResource($user),
            'message' => 'User resource retrieved successfully',
        ]);
    }
}