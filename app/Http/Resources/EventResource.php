<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'vanue_name' => $this->vanue_name,
            'venue_address' => $this->venue_address,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'duration' => $this->duration,
            'max_capacity' => $this->max_capacity,
            'expected_attendees' => $this->expected_attendees,
            'sales_target' => $this->sales_target,
            'early_bird_deadline' => $this->early_bird_deadline,
            'refund_policy' => $this->refund_policy,
            'published_at' => $this->published_at,
            'status' => $this->status,
            'organizer' => new ClientResource($this->client),
            'tickets' => TicketResource::collection($this->tickets),
            'bio' => new EventBioResource($this->bio),
        ];
    }
}
