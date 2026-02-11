<?php

use App\Http\Controllers\EventBioController;
use App\Http\Controllers\EventSponsorsController;
use App\Http\Controllers\EventVenueController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HeroMediaController;
use App\Http\Controllers\TicketMediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMediaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 *TODO: revamp the registration flow to allow users to first register and then select the type of account they want (business, individual, etc). 
 *This will make the registration process smoother and less overwhelming for users. We can then prompt them to fill in the necessary details based 
 *on the type of account they select. This will also allow us to implement a more flexible and scalable registration system that can accommodate different types of users in the future.
 * 
 */


Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/me', [AuthController::class, 'me'])->middleware(['auth:sanctum']);
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('/events')->group(function () {
    Route::get('/', [EventController::class, 'getEvents'])->middleware(['auth:sanctum']);
    Route::post('/', [EventController::class, 'createEvent'])->middleware(['auth:sanctum']);
    Route::get('/tickets/types', [EventController::class, 'getEventTypes'])->middleware(['auth:sanctum']);
    Route::post('/tickets', [EventController::class, 'createTicketForEvent'])->middleware(['auth:sanctum']);

    // TODO: Add routes to complete crud for events and tickets

    Route::prefix('/media')->group(function () {

        // TODO: make most of these invokable controllers 

        Route::post('/hero', HeroMediaController::class)->middleware(['auth:sanctum']);
        // Route::post('/key-event-details', [EventMediaController::class, 'uploadGallery'])->middleware(['auth:sanctum']); // skip for now
        Route::post('/ticket', TicketMediaController::class)->middleware(['auth:sanctum']);
        Route::post('/bio', EventBioController::class)->middleware(['auth:sanctum']);
        // Route::post('/description', [EventMediaController::class, 'uploadDescription'])->middleware(['auth:sanctum']); // part of the bio
        Route::post('/sponsors', EventSponsorsController::class)->middleware(['auth:sanctum']);
        Route::post('/venue', EventVenueController::class)->middleware(['auth:sanctum']);
        // Route::post('/schedule', [EventMediaController::class, 'uploadSchedule'])->middleware(['auth:sanctum']);
        // Route::post('/legal-info', [EventMediaController::class, 'uploadLegalInfo'])->middleware(['auth:sanctum']);
        Route::post('/faq', FaqController::class)->middleware(['auth:sanctum']);
        // Route::post('/footer', [EventMediaController::class, 'uploadFooter'])->middleware(['auth:sanctum']); // this will have social media.
    });
});

Route::get('/{username}/{eventname}', [EventController::class, 'getPublicEvents']);

Route::get('/events', [EventController::class, 'getPublicEventsList']);