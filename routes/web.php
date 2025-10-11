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

Route::get('/', function () {
    return view('landing');
});

// Basic route examples
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

// Public routes
Route::get('/quotes', [QuotesController::class, 'index']);
Route::get('/quotes/author/{author}', [QuotesController::class, 'filterByAuthor']);
Route::get('/products', [ProductsController::class, 'index']);

// Guest routes (for non-authenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/sign-up', [SignUpsController::class, 'index']);
    Route::post('/sign-up', [SignUpsController::class, 'store']);
});

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Users Management Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/', [UsersController::class, 'store'])->name('users.store');
        Route::get('/{user}', [UsersController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
    });

    // Tasks Management Routes
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TasksController::class, 'index'])->name('tasks.index');
        Route::get('/create', [TasksController::class, 'create'])->name('tasks.create');
        Route::post('/', [TasksController::class, 'store'])->name('tasks.store');
        Route::get('/{task}', [TasksController::class, 'show'])->name('tasks.show');
        Route::get('/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
        Route::put('/{task}', [TasksController::class, 'update'])->name('tasks.update');
        Route::delete('/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
        
        // Additional task-specific routes
        Route::patch('/{task}/complete', [TasksController::class, 'complete'])->name('tasks.complete');
        Route::patch('/{task}/incomplete', [TasksController::class, 'incomplete'])->name('tasks.incomplete');
    });

    // Alternative: You can also use resource routes (more concise)
    // Route::resource('users', UsersController::class);
    // Route::resource('tasks', TasksController::class);
});