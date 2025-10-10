<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SignUpsController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\ProductsController;
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
//return a string 
Route::get('/page1', function () {
    return 'Hello World';
});
//return a variable
Route::get('/page2', function () {
    $message = 'Hello Again';
    return $message;
});
//return an array
Route::get('/page3', function () {
    $arr = [1,2,3];
    return $arr;
});
//return a view
Route::get('/page4', [PagesController::class, 'page4']);

//return a view inside a folder
Route::get('/page5', [PagesController::class, 'page5']);

//Pass data from view to controller and vice versa
Route::get('/sign-up', [SignUpsController::class, 'index']);

//Foreach Loops in blade
Route::get('/quotes', [QuotesController::class, 'index']);

//how to take care of a route that keeps changing
//use wildcards {}- for parts of route that isn't static

Route::get('/quotes/author/{author}', [QuotesController::class, 'filterByAuthor']);

//create your route for products
Route::get('/products', [ProductsController::class, 'index']);

// Route for the users index page
Route::get('/users', [UserController::class, 'index'])->name('users.index');

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
