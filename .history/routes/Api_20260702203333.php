<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VillaController;
use App\Http\Controllers\Api\BookingController;

Route::prefix('v1')->group(function () {
    // Villa API
    Route::get('/villas', [VillaController::class, 'index']);
    Route::get('/villas/{id}', [VillaController::class, 'show']);
    Route::post('/villas', [VillaController::class, 'store']);
    Route::put('/villas/{id}', [VillaController::class, 'update']);
    Route::delete('/villas/{id}', [VillaController::class, 'destroy']);

    // Booking API
    Route::post('/villas/{id}/book', [BookingController::class, 'store']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'cancel']);
    Route::post('/bookings/{id}/confirm', [BookingController::class, 'confirm']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
});