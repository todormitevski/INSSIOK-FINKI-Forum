<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('register', [AuthController::class, 'showRegister'] )->name('show.register');
Route::get('login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('majors', MajorController::class)->only(['index', 'show']);
Route::resource('subjects', SubjectController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('posts/{post}/comments', [CommentController::class, 'index']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::resource('attachments', AttachmentController::class);
    Route::resource('users', AuthController::class);
});
