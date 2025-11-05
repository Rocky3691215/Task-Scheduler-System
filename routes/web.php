<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

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
    if (auth()->check()) {
        return auth()->user()->isAdmin() 
            ? redirect()->route('admin.dashboard')
            : redirect()->route('users.dashboard');
    }
    return view('landing');
});

// Guest routes (Login/Signup)
Route::middleware('guest')->group(function () {
    // Regular user login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Admin login
    Route::get('admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
    
    // User signup
    Route::get('/sign-up', [SignUpsController::class, 'index'])->name('signup');
    Route::post('/sign-up', [SignUpsController::class, 'store'])->name('signup.store');
});

// Admin routes (protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    // Admin users list (open when admin clicks "Users")
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});

// User routes (protected)
Route::middleware('auth')->group(function () {
    // User dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('users.dashboard');
    })->name('users.dashboard');

    // Tasks page
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // User profile management
    Route::get('/profile/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/profile', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/profile', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::put('/profile/password', [UsersController::class, 'updatePassword'])->name('users.password.update');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
