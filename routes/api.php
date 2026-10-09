<?php

use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/users', [UserController::class, "store"]);
Route::post('/users/{id}/validation', [UserController::class, 'validate'])->middleware('auth:sanctum');
Route::patch('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');

Route::get('/session', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::post('/session',[UserController::class, "login"]);
Route::delete('/session', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/works', [WorkController::class, 'showAll'])->middleware('auth:sanctum');
Route::post('/works', [WorkController::class, 'store'])->middleware('auth:sanctum');
Route::get('/works/{id}', [WorkController::class, 'showOne'])->middleware('auth:sanctum');

Route::post('/types', [TypeController::class, 'store'])->middleware('auth:sanctum');
