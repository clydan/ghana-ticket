<?php

namespace App\Http\Controllers;

use App\Actions\Event\Media\Ticket;
use App\Http\Requests\TicketMediaRequest;
use Illuminate\Http\Request;

class TicketMediaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TicketMediaRequest $request, Ticket $action)
    {
        return $action->execute();
    }
}
