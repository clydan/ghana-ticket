<?php

namespace App\Http\Controllers;

use App\Actions\Public\AllEventsAction;
use Illuminate\Http\Request;
use App\Actions\Event\Events;
use App\Actions\Event\CreateEvent;
use App\Actions\Event\EventTicketType;
use App\Actions\Public\GetEventAction;
use App\Actions\Event\CreateEventTicket;
use App\Http\Requests\EventCreateRequest;

class EventController extends Controller
{
    public function getEvents(Events $action)
    {
        return $action->execute();
    }

    public function getEventTypes(EventTicketType $action)
    {
        return $action->execute();
    }

    public function createEvent(EventCreateRequest $request, CreateEvent $action)
    {
        return $action->execute();
    }

    public function createTicketForEvent(Request $request, CreateEventTicket $action)
    {
        return $action->execute();
    }

    public function getPublicEvents($username, $eventname, GetEventAction $action)
    {
        return $action->execute($username, $eventname);
    }

    public function getPublicEventsList(AllEventsAction $action)
    {
        return $action->execute();
    }
}
