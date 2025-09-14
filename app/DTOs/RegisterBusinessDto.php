<?php

namespace App\DTOs;

use App\Models\User;
use Spatie\LaravelData\Data;

class RegisterBusinessDto extends Data
{
    public function __construct(
        public string $businessName,
        public string $businessAddress,
        public string $businessCity,
        public string $businessEmail,
        public User $user,
    )
    {
        //
    }
}