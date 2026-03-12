<?php

use App\Http\Controllers\Api\FruitController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;


Route::prefix('api')->group(function () {
    Route::apiResource('fruits', FruitController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('reservations', ReservationController::class);
});