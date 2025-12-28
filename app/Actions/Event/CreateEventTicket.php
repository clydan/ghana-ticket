<?php

namespace App\Actions\Event;

use App\Exceptions\GeneralExceptionHandler;
use App\Models\Event;
use App\Models\TicketType;
use Arr;

class CreateEventTicket
{
    public function __construct()
    {
        //
    }

    public function execute()
    {
        $data = request()->all();

        $eventId = $data['event_id'];
        $event = Event::where('uuid', $eventId)->firstOrFail();

        throw_if(
            blank($event),
            new GeneralExceptionHandler('Event not found.', 404),
        );

        $ticketTypeId = $data['ticket_type_id'];
        $ticketType = TicketType::where('uuid', $ticketTypeId)->first();

        throw_if(
            blank($ticketType),
            new GeneralExceptionHandler('Ticket type not found.', 404),
        );

        $eventTicket = $event->tickets()->where('ticket_type_id', $ticketType->id)->first();

        throw_if(
            !blank($eventTicket),
            new GeneralExceptionHandler('Ticket of this type already exists for the event.', 409),
        );

        $ticket = $event->tickets()->create([
            'ticket_type_id' => $ticketType->id,
            'event_id' => $event->id,
            'price' => Arr::get($data, 'price'),
            'quantity_available' => Arr::get($data, 'quantity_available'),
            'quantity_sold' => 0,
            'sales_start_datetime' => Arr::get($data, 'sales_start_datetime'),
            'sales_end_datetime' => Arr::get($data, 'sales_end_datetime'),
        ]);

        return response()->json([
            'status' => 201,
            'data' => new \App\Http\Resources\TicketResource($ticket),
            'message' => 'Ticket created successfully for the event.',
        ]);
    }
}