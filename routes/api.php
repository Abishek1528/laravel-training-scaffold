<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class)->names('api.projects');
    Route::apiResource('projects.tasks', TaskController::class)->names('api.projects.tasks');
});

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
