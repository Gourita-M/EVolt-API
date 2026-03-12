<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StatsController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('reservations', ReservationController::class)->middleware('auth:sanctum');

Route::get('/stations', [StationController::class, 'index'])->middleware('auth:sanctum');
Route::post('/stations', [StationController::class, 'store'])->middleware('auth:sanctum');


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user();
});

Route::get('/stations/search', [StationController::class, 'search'])->middleware('auth:sanctum');
Route::post('/reservations/Cancel/{id}', [ReservationController::class, 'cancel'])->middleware('auth:sanctum');

Route::get('/History', [SessionController::class, 'history'])->middleware('auth:sanctum');

Route::get('Admin/Statistics', [StatsController::class, 'index'])->middleware('auth:sanctum');