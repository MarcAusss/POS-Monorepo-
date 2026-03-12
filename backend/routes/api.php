<?php

use App\Http\Controllers\Api\FruitController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Public
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reservations', [ReservationController::class, 'store']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::apiResource('fruits', FruitController::class);
    Route::apiResource('reservations', ReservationController::class)->except(['store']);
    Route::apiResource('transaction', TransactionController::class)->except(['store']);
});