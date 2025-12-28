<?php

namespace App\Actions\Event;

use App\Http\Resources\EventResource;

class Events
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        $client = auth()->user()->client;
        $events = $client->events;

        return response()->json([
            'status' => 200,
            'data' => EventResource::collection($events),
            'message' => 'Events retrieved successfully.',
        ]);
    }   
}