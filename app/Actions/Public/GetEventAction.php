<?php

namespace App\Actions\Public;

use App\Exceptions\GeneralExceptionHandler;
use App\Http\Resources\EventResource;
use App\Models\Client;

class GetEventAction
{
    public function execute($username, $eventname)
    {
        $client = Client::with('events')->whereSlug($username)->first();

        throw_if(
            blank($client),
            new GeneralExceptionHandler("Client with username {$username} not found.")
        );

        $event = $client->events()->whereSlug($eventname)->first();

        throw_if(
            blank($event),
            new GeneralExceptionHandler("Event with name {$eventname} not found for client {$username}.")
        );

        return response()->json([
            'status' => 200,
            'data' => EventResource::make($event),
            'message' => 'Event retrieved successfully.'
        ]);
    }
}