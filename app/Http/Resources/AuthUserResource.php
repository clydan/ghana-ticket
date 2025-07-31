<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->destroyOldToken();
        $tokenName = env('GENERAL_TOKEN_NAME');
        $token = $this->getToken();

        return [
            'id' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'auth' => [
                'name' => $tokenName,
                'token' => $token,
            ],
        ];
    }

    private function destroyOldToken()
    {
        $this->tokens()->where('name', env('GENERAL_TOKEN_NAME'))->first()?->delete();
    }

    private function getToken()
    {
        return $this->createToken(env('GENERAL_TOKEN_NAME'))->plainTextToken;
    }
}
