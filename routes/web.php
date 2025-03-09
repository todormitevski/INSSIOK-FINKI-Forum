<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('majors', MajorController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('posts', PostController::class);
Route::get('posts/{post}/comments', [CommentController::class, 'index']);
Route::post('posts/{post}/comments', [CommentController::class, 'store']);
Route::resource('attachments', AttachmentController::class);
