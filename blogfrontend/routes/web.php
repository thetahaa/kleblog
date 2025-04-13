<?php

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\tokenmiddleware;

Route::get('/', function () {
    return view('data');
});

Route::post('/', function () {
    return view('data');
});

Route::get('/game', function () {
    return view('game');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware([tokenmiddleware::class])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('posts', [PostController::class, 'index'])->name('post.index');
    Route::get('posts/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('posts/{posts}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('kvkk', [PrivacyPolicyController::class, 'show']);
});

