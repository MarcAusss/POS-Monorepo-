<?php

use App\Http\Controllers\FruitController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// routes/api.php
Route::apiResource('fruits', FruitController::class);
Route::apiResource('transactions', TransactionController::class);
Route::apiResource('reservations', ReservationController::class); 