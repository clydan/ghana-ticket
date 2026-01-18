<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventVenueResource extends JsonResource
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
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'gps' => $this->gps,
            'google_maps_link' => $this->google_maps_link,
            'floor_number' => $this->floor_number,
            'room_number' => $this->room_number,
        ];
    }
}
