<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Http\Requests\StoreBorrowingRequest;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc') 
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function store(StoreBorrowingRequest $request)
    {
        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return back()->withErrors(['msg' => 'Stok buku habis']);
        }

        $activeBorrow = Borrowing::where('user_id', Auth::id())
            ->where('status', 'BORROWED')
            ->count();

        if ($activeBorrow >= 3) {
            return back()->withErrors(['msg' => 'Maksimal meminjam 3 buku bersamaan']);
        }

        Borrowing::create([
            'user_id'         => Auth::id(),
            'book_id'         => $book->id,
            'borrow_date'     => now(),
            'return_deadline' => now()->addDays(7),
            'status'          => 'BORROWED'
        ]);

        $book->decrement('stock');

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id()) {
            abort(403);
        }
        
        if ($borrowing->status === 'RETURNED') {
             return back();
        }

        $borrowing->update([
            'status'      => 'RETURNED',
            'return_date' => now()
        ]);

        $borrowing->book->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}