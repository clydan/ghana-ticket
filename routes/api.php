<?php

use App\Http\Controllers\HeroMediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMediaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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
        Route::post('/key-event-details', [EventMediaController::class, 'uploadGallery'])->middleware(['auth:sanctum']);
        Route::post('/tickets', [EventMediaController::class, 'uploadTicket'])->middleware(['auth:sanctum']);
        Route::post('/bios', [EventMediaController::class, 'uploadBio'])->middleware(['auth:sanctum']);
        Route::post('/description', [EventMediaController::class, 'uploadDescription'])->middleware(['auth:sanctum']);
        Route::post('/sponsors', [EventMediaController::class, 'uploadSponsor'])->middleware(['auth:sanctum']);
        Route::post('/venue', [EventMediaController::class, 'uploadVenue'])->middleware(['auth:sanctum']);
        Route::post('/schedule', [EventMediaController::class, 'uploadSchedule'])->middleware(['auth:sanctum']);
        Route::post('/legal-info', [EventMediaController::class, 'uploadLegalInfo'])->middleware(['auth:sanctum']);
        Route::post('/faq', [EventMediaController::class, 'uploadFaq'])->middleware(['auth:sanctum']);
        Route::post('/footer', [EventMediaController::class, 'uploadFooter'])->middleware(['auth:sanctum']);
    });
});
