<?php

use App\Http\Controllers\Api\FruitController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

// Public reservation creation
Route::post('reservations', [ReservationController::class,'store']);

// Admin routes
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('fruits', FruitController::class); // Admin CRUD fruits
    Route::apiResource('reservations', ReservationController::class)->except(['store']); // Admin views
    Route::apiResource('transaction', TransactionController::class)->except(['store']); // Admin views
});