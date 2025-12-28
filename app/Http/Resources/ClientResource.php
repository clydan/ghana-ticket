<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'business_name' => $this->business_name,
            'address' => $this->address,
            'country' => $this->country,
            'city' => $this->city,
            'business_category' => $this->business_category,
            'business_type' => $this->business_type,
            'business_email' => $this->business_email,
            'business_facebook_url' => $this->business_facebook_url,
            'business_twitter_url' => $this->business_twitter_url,
            'business_instagram_url' => $this->business_instagram_url,
            'business_whatsapp_number' => $this->business_whatsapp_number,
            'business_contact' => $this->business_contact, 
            'tax_identification_number' => $this->tax_identification_number,
            'business_description' => $this->business_description,
        ];
    }
}
