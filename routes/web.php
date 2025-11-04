<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;

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

//Pass data from view to controller and vice versa
Route::get('/sign-up', [SignUpsController::class, 'index']);

// Route for the users index page
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::resource('users', UsersController::class);
Route::get('/user/{users}', 'UsersController@show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/sign-up', [SignUpsController::class, 'index']);
    Route::post('/sign-up', [SignUpsController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
