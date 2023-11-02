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

Route::middleware('auth:api')->prefix('ticket')->group(function () {
    Route::get("/",[\App\Http\Controllers\TicketController::class,"userTickets"]);
    Route::post("/",[\App\Http\Controllers\TicketController::class,"create"]);
    Route::post("/{id}",[\App\Http\Controllers\TicketController::class,"changeStatus"]);

});

Route::middleware('auth:api')->prefix('service')->group(function () {
    Route::post("/",[\App\Http\Controllers\ServiceController::class,"store"]);
    Route::get("/",[\App\Http\Controllers\ServiceController::class,"index"]);

});
