<?php
// import Facades Routes
use Illuminate\Support\Facades\Route;

// import RegisterController
use App\Http\Controllers\Auth\RegisterController;

// import LoginController
use App\Http\Controllers\Auth\LoginController;

// import LogoutController
use App\Http\Controllers\Auth\LogoutController;

// import DashboardController
use App\Http\Controllers\DashboardController;

// import DashboardController
use App\Http\Controllers\PostController;

// import DashboardController
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home route
Route::get('/', function() {
    return view('home');
})->name('home');

// Post route
Route::get('/posts', function () {
    return view('posts.index');
});

// Dashboard Route via controller
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Register Route via controller
Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Register Post route
Route::post('/register', [RegisterController::class, 'store']);

// Login Route via controller
Route::get('/login', [LoginController::class, 'index'])->name('login');
// Login Post route
Route::post('/login', [LoginController::class, 'store']);

// Logout Route via controller
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Posts Route via controller
Route::get('/posts', [PostController::class, 'index'])->name('posts');
// Posts Post route
Route::post('/posts', [PostController::class, 'store']);
// Delete Post route - Note: {post} = Post model
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// (Individual) Post Route
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


// Like Post route - Note: {post} = Post model
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
// Unlike Post route - Note: {post} = Post model
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

// User Profile
Route::get('users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');
