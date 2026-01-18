<?php

namespace App\Actions\Event\Media;

use App\Exceptions\GeneralExceptionHandler;
use App\Http\Resources\EventBioResource;
use App\Models\Event;
use Illuminate\Support\Arr;

class Bio
{
    public function execute()
    {
        $data = request()->all();

        $eventId = Arr::get($data, 'event_id');
        $title = Arr::get($data, 'title');
        $subtitle = Arr::get($data, 'subtitle');    
        $content = Arr::get($data, 'content');

        $event = Event::where('uuid', $eventId)->first();

         throw_if(
            blank($event),
            new GeneralExceptionHandler('Event not found.')
         );

         $event->bio()->firstOrCreate(
            [
                'event_id' => $event->id,
            ],
            [
            'title' => $title,
            'subtitle' => $subtitle,
            'content' => $content,
        ]);

        return response()->json([
            'status' => 200,
            'data' => new EventBioResource($event->bio),
            'message' => 'Event bio created successfully.',
        ]);
    }
}