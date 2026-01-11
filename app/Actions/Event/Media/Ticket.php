<?php

namespace App\Actions\Event\Media;

use App\Exceptions\GeneralExceptionHandler;
use App\Http\Resources\TicketResource;
use App\Models\Ticket as TicketModel;
use Auth;

class Ticket
{
    public function execute()
    {
        $ticketId = request()->input('ticket_id');
        $client = Auth::user()->client;
        $ticket = TicketModel::where('uuid', $ticketId)
            // ->whereHas('event', function ($query) use ($client) {
            //     $query->where('client_id', $client->id);
            // })
            ->first();

        throw_if(
            blank($ticket),
            new GeneralExceptionHandler('Ticket not found or you do not have permission to modify this ticket media.')
        );

        $event = $ticket->event;

        throw_if(
            blank($event) || $client->id === $event->client->organizer_id,
            new GeneralExceptionHandler('Unknown ticket. Client might now own ticket')
        );

        $path = request()
            ->file('ticket_image')
            ->store('uploads/ticket_images', 'public');

        $ticket->image()->create([
            'path' => $path,
        ]);

        return response()->json([
            'status' => 200,
            'data' => new TicketResource($ticket),
            'message' => 'Ticket media uploaded successfully.',
        ]);
    }
}
