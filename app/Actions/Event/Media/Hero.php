<?php

namespace App\Actions\Event\Media;

use App\Exceptions\GeneralExceptionHandler;
use App\Http\Resources\HeroMediaResource;
use Arr;
use Illuminate\Support\Facades\Auth;

class Hero
{
    public function execute()
    {
        $data = request()->all();

        $eventId = Arr::get($data, 'event_id');
        $heroTitle = Arr::get($data, 'hero_title');
        $heroSubtitle = Arr::get($data, 'hero_subtitle');

        $event = Auth::user()
            ->client
            ->events()
            ->whereUuid($eventId)
            ->first();

        throw_if(
            blank($event),
            new GeneralExceptionHandler(
                'Event not found or you do not have permission to modify it.'
            )
        );

        try {

            /** @var \App\Models\HeroMedia $hero */
            $hero = $event->heroMedia()->updateOrCreate(
                ['event_id' => $event->id],
                [
                    'hero_title' => $heroTitle,
                    'hero_subtitle' => $heroSubtitle,
                ]
            );

            $hasImage = $hero->images()->exists();

            if (! $hasImage && request()->hasFile('hero_image')) {

                $path = request()
                    ->file('hero_image')
                    ->store('uploads/hero_images', 'public');

                $hero->images()->create([
                    'path' => $path,
                ]);
            }

        } catch (\Throwable $th) {
            throw new GeneralExceptionHandler(
                'Failed to create hero media: '.$th->getMessage()
            );
        }

        return response()->json([
            'status' => 200,
            'data' => new HeroMediaResource($hero),
            'message' => 'Hero media retrieved successfully.',
        ]);
    }
}
