<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostApiController;


Route::apiResource('posts', PostApiController::class);
Route::apiResource('posts', PostApiController::class)->only(['index', 'show']);
Route::middleware('auth:sanctum')->apiResource('posts', PostApiController::class)->only(['store', 'update', 'destroy']);