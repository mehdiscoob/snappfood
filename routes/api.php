<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->group(function () {
Route::post("/",[\App\Http\Controllers\UserController::class,"register"]);
Route::get("/{id}",[\App\Http\Controllers\UserController::class,'getUserById'])->middleware('auth:api');
Route::post("verify/{id}",[\App\Http\Controllers\UserController::class,'verifyAccount'])->middleware('auth:api');
});

Route::middleware('auth:api')->prefix('order')->group(function () {
//    Route::get("/",[\App\Http\Controllers\Order\OrderController::class,"userTickets"]);
    Route::post("/",[\App\Http\Controllers\Order\OrderController::class,"createOrder"]);
});

Route::middleware('auth:api')->prefix('delay')->group(function () {
    Route::post("/",[\App\Http\Controllers\DelayReport\DelayReportController::class,"createDelayTime"]);
    Route::get("/vendor/order/time/{id}",[\App\Http\Controllers\DelayReport\DelayReportController::class,"getByReportOrderByDelayTime"]);
    Route::post("/agent",[\App\Http\Controllers\DelayReport\DelayReportController::class,"assignDelayReportToAgent"]);
});

Route::middleware('auth:api')->prefix('trip')->group(function () {
    Route::post("/",[\App\Http\Controllers\Trip\TripController::class,"createTrip"]);
});
