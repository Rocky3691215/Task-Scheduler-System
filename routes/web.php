<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpsController;
use App\Http\Controllers\AccountSyncController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('landing');
});

Route::get('/sign-up', function () {
    return view('sign-up');
});

Route::post('/sign-up', [SignUpsController::class, 'store']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        if (Auth::user()->email === 'admin@user.com') {
            return redirect('/account_sync');
        }
        return view('home');
    })->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Account Sync routes
    Route::get('account_sync/selective-sync/create', [AccountSyncController::class, 'showSelectiveSyncForm'])->name('account_sync.show_selective_sync');
    Route::post('account_sync/selective-sync', [AccountSyncController::class, 'saveSelectiveSync'])->name('account_sync.save_selective_sync');
    Route::post('/account_sync/{accountSync}/sync-now', [AccountSyncController::class, 'syncNow'])->name('account_sync.sync-now');
    Route::resource('account_sync', AccountSyncController::class);
});
