<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\HistoryStoryController;
use App\Http\Controllers\StoryContentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ConversationContentController;
use Illuminate\Support\Facades\Route;
use App\Models\Artikel; 
use App\Models\Story; 
use App\Models\HistoryStory;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $stories = Story::latest()->get();
    $histories = HistoryStory::where('user_id', auth()->id())->latest()->get();
    return view('dashboard', compact('stories', 'histories'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('stories', StoryController::class);
    Route::resource('story-contents', StoryContentController::class);
    Route::get('/story/{storyId}/content/create', [StoryContentController::class, 'create'])->name('story-contents.create');
    Route::post('/story/{storyId}/content', [StoryContentController::class, 'store'])->name('story-contents.store');
    Route::resource('conversations', ConversationController::class);
    Route::resource('conversation-contents', ConversationContentController::class);
    Route::get('/histories', [HistoryStoryController::class, 'index'])->name('history.index');
    Route::get('/history/{id}', [App\Http\Controllers\HistoryStoryController::class, 'show'])->name('history.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
