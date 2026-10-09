<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/session', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/users', [UserController::class, "store"]);
Route::post('/session',[UserController::class, "login"]);
