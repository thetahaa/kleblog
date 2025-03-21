<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'login']);
Route::post('/posts', [PostController::class, 'posts']);


Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/profile', [LoginController::class, 'profile']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{id}', [PostController::class, 'show']);
});

Route::get('/welcome', function () {
    return view('welcome');
});

// Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);