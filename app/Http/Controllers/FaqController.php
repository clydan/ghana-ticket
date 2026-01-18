<?php

namespace App\Http\Controllers;

use App\Actions\Event\Media\EventFaq;
use App\Http\Requests\FaqRequest;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FaqRequest $request, EventFaq $action)
    {
        return $action->execute();
    }
}
