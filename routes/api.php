<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FilesController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\ProjectsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::post('authenticate', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectsController::class);
    Route::apiResource('tasks', TasksController::class)->except(['index', 'show']);
    Route::post('upload', [FilesController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



