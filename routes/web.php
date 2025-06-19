<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('majors', MajorController::class)->only(['index', 'show']);
Route::resource('subjects', SubjectController::class)->only(['index', 'show']);
Route::get('/subjects/search', [SubjectController::class, 'search'])->name('subjects.search');

Route::middleware('auth')->group(function () {
    Route::get('/subjects/{subject}/posts/create', [PostController::class, 'create'])
        ->name('subjects.posts.create');
    Route::post('/subjects/{subject}/posts', [PostController::class, 'storeForSubject'])
        ->name('subjects.posts.store');
    Route::resource('posts', PostController::class);
    Route::get('posts/{post}/comments', [CommentController::class, 'index']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])
        ->name('posts.comments.store');
    Route::get('/comments/{comment}/thread', [CommentController::class, 'thread'])
        ->name('comments.thread');
    Route::resource('attachments', AttachmentController::class);
    Route::get('/attachments/{id}/download', [AttachmentController::class, 'download'])->name('attachments.download');
    Route::resource('users', AuthController::class);
});
