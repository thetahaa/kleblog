<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/profile', [LoginController::class, 'profile']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{id}', [PostController::class, 'show'])->name('post.show');
    Route::post('posts/{posts}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::get('kvkk', [PrivacyPolicyController::class, 'kvkk']);
    Route::get('gizlilik-politikasi', [PrivacyPolicyController::class, 'privacyPolicy']);
});
