<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FeedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/feed', [FeedController::class, 'index']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

