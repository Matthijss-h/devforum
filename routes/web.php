<?php

use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');

// Topic routes
Route::middleware('auth')->group(function () {
    Route::get('/threads/{thread}/topics/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/threads/{thread}/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/threads/{thread}/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topics.edit');
    Route::patch('/threads/{thread}/topics/{topic}', [TopicController::class, 'update'])->name('topics.update');
    Route::delete('/threads/{thread}/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');
    
    // Reply routes
    Route::post('/threads/{thread}/topics/{topic}/replies', [ReplyController::class, 'store'])->name('replies.store');
    Route::delete('/threads/{thread}/topics/{topic}/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
});

Route::get('/threads/{thread}/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';