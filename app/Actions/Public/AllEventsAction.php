<?php

namespace App\Actions\Public;

use App\Http\Resources\AllEventsResource;
use App\Models\Event;

class AllEventsAction
{
    public function execute()
    {
        $events = Event::where('status', 'PUBLISHED')
        ->orderByDesc('published_at')
        ->get();

        return response()->json([
            'status' => 200,
            'data' => AllEventsResource::collection($events),
            'message' => 'Events retrieved successfully.'
        ]);
    }
}