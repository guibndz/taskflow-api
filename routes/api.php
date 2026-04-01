<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskTagController;
use App\Http\Controllers\ProfileController;

// 1 e 2. Projects e Tasks Aninhadas
Route::prefix('projects')->group(function () {
    // Endpoints de Projects
    Route::get('/', [ProjectController::class, 'index']);
    Route::post('/', [ProjectController::class, 'store']);
    Route::get('/{id}', [ProjectController::class, 'show']);
    Route::put('/{id}', [ProjectController::class, 'update']);
    Route::delete('/{id}', [ProjectController::class, 'destroy']);

    // Endpoints de Tasks (Aninhadas dentro do prefixo projects/{id})
    Route::prefix('{id}/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/', [TaskController::class, 'store']);
        Route::get('/{taskId}', [TaskController::class, 'show']);
        Route::put('/{taskId}', [TaskController::class, 'update']);
        Route::delete('/{taskId}', [TaskController::class, 'destroy']);
        Route::patch('/{taskId}/status', [TaskController::class, 'updateStatus']); // PATCH apenas para status
    });
});

// 3. Tags
Route::prefix('tags')->group(function () {
    Route::get('/', [TagController::class, 'index']);
    Route::post('/', [TagController::class, 'store']);
});

// 4. Associação Task-Tag
Route::prefix('tasks/{taskId}/tags/{tagId}')->group(function () {
    Route::post('/', [TaskTagController::class, 'attach']);
    Route::delete('/', [TaskTagController::class, 'detach']);
});

// 5. Profile
Route::prefix('users/{id}/profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show']);
    Route::put('/', [ProfileController::class, 'update']);
});