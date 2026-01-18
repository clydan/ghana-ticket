<?php

namespace App\Actions\Event\Media;

use App\Http\Resources\EventVenueResource;
use App\Models\Event;
use Arr;

class Venue
{
    public function execute()
    {
        $data = request()->all();

        $eventId = Arr::get($data, 'event_id');

        $data = [
            'country' => Arr::get($data, 'country'),
            'city' => Arr::get($data, 'city'),
            'address' => Arr::get($data, 'address'),
            'gps' => Arr::get($data, 'gps'),
            'google_maps_link' => Arr::get($data, 'google_maps_link'),
            'floor_number' => Arr::get($data, 'floor_number'),
            'room_number' => Arr::get($data, 'room_number'),
        ];

        $event = Event::whereUuid($eventId)->first();

        throw_if(
            blank($event),
            new \Exception('Event not found.')
        );

        $event->venue()->updateOrCreate(
            ['event_id' => $event->id],
            $data
        );

        return response()->json([
            'status' => 200,
            'data' => new EventVenueResource($event->venue),
            'message' => 'Venue media uploaded successfully.',
        ]);
    }
}