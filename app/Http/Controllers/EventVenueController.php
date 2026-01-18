<?php

namespace App\Http\Controllers;

use App\Actions\Event\Media\Venue;
use App\Http\Requests\EventVenueRequest;
use Illuminate\Http\Request;

class EventVenueController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EventVenueRequest $request, Venue $action)
    {
        return $action->execute();
    }
}
