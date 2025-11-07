<?php
// web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SignUpsController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageAttachmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return view('landing');
});

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
Route::get('/sign-up', [SignUpsController::class, 'index']);
Route::get('/quotes', [QuotesController::class, 'index']);
Route::get('/quotes/author/{author}', [QuotesController::class, 'filterByAuthor']);
Route::get('/products', [ProductsController::class, 'index']);

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/sign-up', [SignUpsController::class, 'index']);
    Route::post('/sign-up', [SignUpsController::class, 'store']);
});

Route::middleware('auth')->group(function (){
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Image Attachments Routes - ALL PUBLIC (No login required)
Route::get('/image_attachments', [ImageAttachmentController::class, 'index'])->name('image_attachments.index');
Route::get('/image_attachments/create', [ImageAttachmentController::class, 'create'])->name('image_attachments.create');
Route::post('/image_attachments', [ImageAttachmentController::class, 'store'])->name('image_attachments.store');
Route::get('/image_attachments/{id}', [ImageAttachmentController::class, 'show'])->name('image_attachments.show');
Route::get('/image_attachments/{id}/edit', [ImageAttachmentController::class, 'edit'])->name('image_attachments.edit');
Route::put('/image_attachments/{id}', [ImageAttachmentController::class, 'update'])->name('image_attachments.update');
Route::delete('/image_attachments/{id}', [ImageAttachmentController::class, 'destroy'])->name('image_attachments.destroy');

// Remove the protected routes group since all image attachment routes are now public
// Route::middleware(['auth'])->group(function () {
//     // This group is now empty or removed
// });