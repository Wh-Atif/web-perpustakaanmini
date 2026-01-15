<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        $activeBorrowings = Borrowing::where('status', 'BORROWED')->count();

        $overdueCount = Borrowing::where('status', 'BORROWED')
            ->where('return_deadline', '<', now())
            ->count();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'activeBorrowings', 'overdueCount'));
    }
}
