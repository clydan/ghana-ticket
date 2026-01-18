<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'price' => $this->price,
            'quantity_available' => $this->quantity_available,
            'quantity_sold' => $this->quantity_sold,
            'sales_start_datetime' => $this->sales_start_datetime,
            'sales_end_datetime' => $this->sales_end_datetime,
            'ticket_type' => new EventTicketTypeResource($this->ticketType),
            'image' => new ImageResource($this->image),
        ];
    }
}
