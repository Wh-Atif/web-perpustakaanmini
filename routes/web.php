<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    
    Route::get('/my-borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    
});


Route::middleware(['auth', 'can:admin-only'])
    ->prefix('admin')       
    ->name('admin.')         
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('books', AdminBookController::class);

        Route::get('/borrowings', [AdminBorrowingController::class, 'index'])->name('borrowings.index');
        Route::put('/borrowings/{borrowing}', [AdminBorrowingController::class, 'update'])->name('borrowings.update');

    });