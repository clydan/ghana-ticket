<?php

namespace App\Actions\Event;

use App\Models\TicketType as Type;
use App\Http\Resources\EventTypeResource;
use App\Http\Resources\EventTicketTypeResource;

class EventTicketType
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        $eventTypes = Type::get();

        return response()->json([
            'status' => 200,
            'data' => EventTicketTypeResource::collection($eventTypes),
            'message' => 'Event types retrieved successfully.',
        ]);
    }
}