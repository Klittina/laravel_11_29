<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LendingController;

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

Route::get('/', function () {
    return view('welcome');
});

//a dashboard egy olyan
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//ezt bárki eléri aki be van jelentkezve
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/order',[BookController::class, 'orderBooksbyAuthor']);
    Route::get('/newest', [CopyController::class, 'theNewest']);
    Route::get('/sendmail', [MailController::class, 'index']);
    Route::get('/file_upload', [FileController::class, 'index']);
    Route::post('/file_upload', [FileController::class, 'store'])->name('file.store');
    Route::get('/mybooksfornow', [LendingController::class, 'mybooksfornow']);
});

Route::middleware(['admin'])->group(function () {
    Route::delete('/api/books/{id}', [BookController::class, 'destroy']);
    Route::get('/api/justuser', [UserController::class, 'justuser']);
});

//
Route::middleware(['librarian'])->group(function () {
    Route::get('/api/books', [BookController::class, 'index']);
    Route::get('/api/books/{id}', [BookController::class, 'show']);
    Route::post('/api/books', [BookController::class, 'store']);
    Route::put('/api/books/{id}', [BookController::class, 'update']);
    Route::get('/api/stock/{id}',[CopyController::class, 'inStock']);
    Route::get('/api/backtoday',[LendingController::class, 'backtoday']);
    Route::get('/api/havereservation',[ReservationController::class, 'havereservation']);
});

Route::get("/testMyQueries/{db}", [CopyController::class, 'atLeast']);

require __DIR__ . '/auth.php';
