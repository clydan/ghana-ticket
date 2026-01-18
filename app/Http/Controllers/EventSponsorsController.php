<?php

namespace App\Http\Controllers;

use App\Actions\Event\Media\Sponsors;
use App\Http\Requests\EventSponsorRequest;
use Illuminate\Http\Request;

class EventSponsorsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EventSponsorRequest $request, Sponsors $action)
    {
        return $action->execute();
    }
}
