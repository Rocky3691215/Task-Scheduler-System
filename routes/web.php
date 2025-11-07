<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SignUpsController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;

// Landing page
Route::get('/', function () {
    return view('landing');
});

// Return a string
Route::get('/page1', function () {
    return 'Hello World';
});

// Return a variable
Route::get('/page2', function () {
    $message = 'Hello Again';
    return $message;
});

// Return an array
Route::get('/page3', function () {
    return [1, 2, 3];
});

// Return a view
Route::get('/page4', [PagesController::class, 'page4']);

// Return a view inside a folder
Route::get('/page5', [PagesController::class, 'page5']);

// Sign-up routes
Route::get('/sign-up', [SignUpsController::class, 'index']);
Route::post('/sign-up', [SignUpsController::class, 'store']);

// Foreach loops in blade
Route::get('/quotes', [QuotesController::class, 'index']);

// Dynamic route with wildcard
Route::get('/quotes/author/{author}', [QuotesController::class, 'filterByAuthor']);

// Products
Route::get('/products', [ProductsController::class, 'index']);

// Admin routes - FIXED: Removed duplicate route
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    // REMOVED: Route::get('/admin/{id}', 'AdminController@show'); // This was duplicate
});