<?php

namespace App\Actions\Event\Media;

use App\Exceptions\GeneralExceptionHandler;
use App\Http\Resources\FaqResource;
use App\Models\Event;
use Illuminate\Support\Arr;

class EventFaq
{
    public function execute()
    {
        $data = request()->all();
        $eventId = Arr::get($data, 'event_id');
        $faqs = Arr::get($data, 'faqs', []);

        $event = Event::whereUuid($eventId)->first();

        throw_if(
            blank($event),
            new GeneralExceptionHandler('Event not found.')
        );

        foreach ($faqs as $faqData) {
            $event->faqs()->create([
                'question' => $faqData['question'],
                'answer' => $faqData['answer'],
                'is_active' => true,
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => FaqResource::collection($event->faqs),
            'message' => 'FAQs added successfully.',
        ]);
    }
}