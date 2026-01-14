<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookUserController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USERS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // =========================
    // USER - BUKU
    // =========================
    Route::get('/books', [BookUserController::class, 'index'])
        ->name('books.index');

    Route::get('/books/{book}', [BookUserController::class, 'show'])
        ->name('books.show');

    // =========================
    // USER - PEMINJAMAN
    // =========================
    Route::get('/borrowings', [BorrowingController::class, 'index'])
        ->name('borrowings.index');

    Route::post('/borrowings', [BorrowingController::class, 'store'])
        ->name('borrowings.store');

    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])
        ->name('borrowings.return');

    // =========================
    // ADMIN AREA
    // =========================
    Route::middleware('can:admin-only')->group(function () {

        // CRUD Buku (Admin)
        Route::resource('/admin/books', BookController::class)
            ->except(['show']);

        // Dashboard Transaksi
        Route::get('/admin/borrowings', [AdminBorrowingController::class, 'index'])
            ->name('admin.borrowings.index');

        // Koreksi Status
        Route::patch('/admin/borrowings/{borrowing}', [AdminBorrowingController::class, 'update'])
            ->name('admin.borrowings.update');
    });
});
