<?php

namespace App\Http\Controllers;

use App\Actions\Event\Media\Bio;
use App\Http\Requests\EventBioRequest;
use Illuminate\Http\Request;

class EventBioController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EventBioRequest $request, Bio $action)
    {
        return $action->execute();
    }
}