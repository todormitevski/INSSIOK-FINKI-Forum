<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'] )->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/majors', [MajorController::class, 'index'])->name('show.majors');
Route::get('/majors/{id}', [MajorController::class, 'view'])->name('view.major');

Route::get('/subject/{id}', [SubjectController::class, 'view'])->name('view.subject');

Route::get('/subject/{id}/post/create', [PostController::class, 'create'])->name('create.post');
Route::post('/subject/{id}/posts', [PostController::class, 'store'])->name('store.post');

Route::resource('/subjects', SubjectController::class);
Route::resource('/posts', PostController::class);
Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
Route::resource('/attachments', AttachmentController::class);
Route::resource('/users', AuthController::class);
