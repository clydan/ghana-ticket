<?php

namespace App\Actions\Event\Media;

use App\Exceptions\GeneralExceptionHandler;
use App\Http\Resources\SponsorResource;
use App\Models\Event;
use Arr;

class Sponsors
{
    public function execute()
    {
        $data = request()->all();
        $eventId = Arr::get($data, 'event_id');
        $sponsors = Arr::get($data, 'sponsors', []);

        $event = Event::whereUuid($eventId)->first();

        throw_if(
            blank($event),
            new GeneralExceptionHandler('Event not found.')
        );

        try{
            foreach($sponsors as $sponsor){
                $path = $sponsor->store('uploads/sponsors', 'public');

                $event->sponsors()->create([
                    'path' => $path,
                ]);
            }
        } catch (\Throwable $th) {
            throw new GeneralExceptionHandler(
                'Failed to upload sponsors: '.$th->getMessage()
            );
        }

        return response()->json([
            'status' => 200,
            'data' => SponsorResource::collection($event->sponsors),
            'message' => 'Sponsors uploaded successfully.',
        ]);

    }
}