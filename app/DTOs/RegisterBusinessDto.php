<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class RegisterBusinessDto extends Data
{
    public function __construct(
        public ?string $business_type_id = null,
        public ?string $business_name = null,
        public ?string $address = null,
        public ?string $country = null,
        public ?string $city = null,
        public ?string $business_category = null,
        public ?string $business_type = null,
        public ?string $business_email = null,
        public ?string $business_facebook_url = null,
        public ?string $business_twitter_url = null,
        public ?string $business_instagram_url = null,
        public ?string $business_whatsapp_number = null,
        public ?string $business_contact = null,
        public ?string $tax_identification_number = null,
        public ?string $business_description = null,
    ) {}
}