<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('main');
// });

// 🟢 Public Routes (No Authentication Required)
Route::get('/', [UserController::class, 'main']);
Route::get('/login', [UserController::class, 'signin'])->name('login');
Route::get('/register', [UserController::class, 'signup'])->name('signup');
Route::post('/login', [UserController::class, 'Login'])->name('loginUser'); 
Route::post('/register', [UserController::class, 'Register'])->name('registerUser'); 
Route::match(['get', 'post'], '/blog', [PostController::class, 'blog'])->name('blog'); 
Route::get('/blog/{slug}', [PostController::class, 'ViewBlog']);

// 🔒 Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout'); 
    Route::get('/dashboard', [UserController::class, 'DashboardUser'])->name('dashboard');

    Route::match(['get', 'post'],'/delete-post/{id}',[PostController::class,'deletePost']);
    
    Route::get('/edit-post/{id}', [PostController::class, 'editPost']);
    Route::post('/edit-post/{id}', [PostController::class, 'updatePost']);

    Route::get('/addpost', [UserController::class, 'showAddPostForm'])->name('Dashboard.AddPost');
    Route::post('/addpost', [UserController::class, 'add_posts'])->name('addPosts');

    Route::match(['get', 'post'], '/allpost', [UserController::class, 'allpost'])->name('all.post'); 
});
