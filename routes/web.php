<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('main');
});

// 🟢 Public Routes (No Authentication Required)
Route::get('/login', [UserController::class, 'signin'])->name('login');
Route::get('/register', [UserController::class, 'signup'])->name('signup');
Route::post('/login', [UserController::class, 'Login'])->name('loginUser'); 
Route::post('/register', [UserController::class, 'Register'])->name('registerUser'); 

// 🔒 Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout'); 
    Route::get('/dashboard', [UserController::class, 'DashboardUser'])->name('dashboard');

    // Post Routes (Only for Logged-in Users)
    Route::get('/addpost', [UserController::class, 'showAddPostForm'])->name('Dashboard.AddPost');
    Route::post('/addpost', [UserController::class, 'add_posts'])->name('addPosts');

    Route::match(['get', 'post'], '/allpost', [UserController::class, 'allpost'])->name('all.post'); 
});
