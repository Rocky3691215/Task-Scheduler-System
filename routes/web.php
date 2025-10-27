<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SignUpsController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes (no login required)
Route::get('/', [TasksController::class, 'index']); // Tasks as homepage
Route::resource('tasks', TasksController::class); // All task routes accessible without login

// Example pages routes
Route::get('/page1', function () {
    return 'Hello World';
});

Route::get('/page2', function () {
    $message = 'Hello Again';
    return $message;
});

Route::get('/page3', function () {
    $arr = [1,2,3];
    return $arr;
});

Route::get('/page4', [PagesController::class, 'page4']);
Route::get('/page5', [PagesController::class, 'page5']);
Route::get('/quotes', [QuotesController::class, 'index']);
Route::get('/quotes/author/{author}', [QuotesController::class, 'filterByAuthor']);
Route::get('/products', [ProductsController::class, 'index']);

// Authentication routes for guests only
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/sign-up', [SignUpsController::class, 'index']);
    Route::post('/sign-up', [SignUpsController::class, 'store']);
});

// Protected routes (login required) - Only non-task routes here
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});