<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ============================================
// PUBLIC ROUTES
// ============================================

// Homepage & Threads look
Route::get('/', [ThreadController::class, 'index'])->name('home');
Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('/thread/{id}', [ThreadController::class, 'show'])->name('threads.show');

// Topic show
Route::get('/thread/{threadId}/topic/{topicId}', [TopicController::class, 'show'])->name('topics.show');

// ============================================
// AUTHENTICATED ROUTES
// ============================================

Route::middleware('auth')->group(function () {

    // Dashboard & Profile
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ----------------------------------------
    // TOPICS
    // ----------------------------------------
    Route::get('/thread/{threadId}/topics/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/thread/{threadId}/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/thread/{threadId}/topic/{topicId}/edit', [TopicController::class, 'edit'])->name('topics.edit');
    Route::put('/thread/{threadId}/topic/{topicId}', [TopicController::class, 'update'])->name('topics.update');


    // ----------------------------------------
    // REPLIES
    // ----------------------------------------
    Route::post('/thread/{threadId}/topic/{topicId}/replies', [ReplyController::class, 'store'])->name('replies.store');
    Route::get('/thread/{threadId}/topic/{topicId}/reply/{replyId}/edit', [ReplyController::class, 'edit'])->name('replies.edit');
    Route::put('/thread/{threadId}/topic/{topicId}/reply/{replyId}', [ReplyController::class, 'update'])->name('replies.update');

});

// ============================================
// ADMIN ONLY ROUTES
// ============================================

Route::middleware(['auth', 'admin'])->group(function () {

    // ----------------------------------------
    // THREADS (Alleen admin!)
    // ----------------------------------------
    Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::get('/thread/{id}/edit', [ThreadController::class, 'edit'])->name('threads.edit');
    Route::put('/thread/{id}', [ThreadController::class, 'update'])->name('threads.update');
    Route::delete('/thread/{id}', [ThreadController::class, 'destroy'])->name('threads.destroy');

    // ----------------------------------------
    // DELETE ROUTES
    // ----------------------------------------
    Route::delete('/thread/{threadId}/topic/{topicId}', [TopicController::class, 'destroy'])->name('topics.destroy');
    Route::delete('/thread/{threadId}/topic/{topicId}/reply/{replyId}', [ReplyController::class, 'destroy'])->name('replies.destroy');

    // ----------------------------------------
    // USERS BEHEER
    // ----------------------------------------
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';
