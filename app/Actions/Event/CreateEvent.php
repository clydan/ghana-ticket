<?php 

namespace App\Actions\Event;

use App\Http\Resources\EventResource;

class CreateEvent
{
    public function __construct()
    {
        //
    }

    public function execute()
    {

        $client = auth()->user()->client;

        $data = request()->all();

        $event = $client->events()->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'],
            'venue_name' => $data['venue_name'],
            'venue_address' => $data['venue_address'],
            'start_datetime' => $data['start_datetime'],
            'end_datetime' => $data['end_datetime'],
            'duration' => $data['duration'],
            'status' => $data['status'] ?? 'DRAFT',
            'max_capacity' => $data['max_capacity'] ?? null,
            'expected_attendees' => $data['expected_attendees'] ?? null,
            'sales_target' => $data['sales_target'] ?? null,
            'early_bird_deadline' => $data['early_bird_deadline'] ?? null,
            'refund_policy' => $data['refund_policy'] ?? null,
        ]);

        return response()->json([
            'status' => 201,
            'data' => new EventResource($event),
            'message' => 'Event created successfully.',
        ]);
    }
}