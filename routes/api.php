<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryApiController;
use App\Http\Controllers\StoryContentApiController;
use App\Http\Controllers\ConversationApiController;
use App\Http\Controllers\ConversationContentApiController;
use App\Http\Controllers\AuthApiController;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/stories', [StoryApiController::class, 'index']);
    Route::get('/stories/{id}', [StoryApiController::class, 'show']);
    Route::post('/stories', [StoryApiController::class, 'store']);
    Route::put('/stories/{id}', [StoryApiController::class, 'update']);
    Route::delete('/stories/{id}', [StoryApiController::class, 'destroy']);

    Route::get('/stories/{storyId}/contents', [StoryContentApiController::class, 'index']);
    Route::post('/stories/{storyId}/contents', [StoryContentApiController::class, 'store']);

    Route::get('/contents/{id}', [StoryContentApiController::class, 'show']);
    Route::put('/contents/{id}', [StoryContentApiController::class, 'update']);
    Route::delete('/contents/{id}', [StoryContentApiController::class, 'destroy']);

    Route::get('/conversations', [ConversationApiController::class, 'index']);
    Route::post('/conversations', [ConversationApiController::class, 'store']);
    Route::get('/conversations/{id}', [ConversationApiController::class, 'show']);
    Route::put('/conversations/{id}', [ConversationApiController::class, 'update']);
    Route::delete('/conversations/{id}', [ConversationApiController::class, 'destroy']);

    Route::get('/contents', [ConversationContentApiController::class, 'index']);
    Route::get('/contents/{id}', [ConversationContentApiController::class, 'show']);
    Route::post('/contents', [ConversationContentApiController::class, 'store']);
    Route::post('/contents/{id}', [ConversationContentApiController::class, 'update']); 
    Route::delete('/contents/{id}', [ConversationContentApiController::class, 'destroy']);
});
