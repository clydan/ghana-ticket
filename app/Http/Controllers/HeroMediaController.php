<?php

namespace App\Http\Controllers;

use App\Actions\Event\Media\Hero;
use App\Http\Requests\HeroMediaRequest;
use Illuminate\Http\Request;

class HeroMediaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(HeroMediaRequest $request, Hero $action)
    {
        return $action->execute();
    }
}
