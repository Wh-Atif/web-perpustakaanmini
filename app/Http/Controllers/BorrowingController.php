<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'BORROWED')
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Borrowing::class);

        $book = Book::findOrFail($request->book_id);

        // RULE: stok harus ada
        if ($book->stock < 1) {
            return back()->withErrors('Stok buku habis');
        }

        // RULE: max 3 buku
        $activeBorrow = Borrowing::where('user_id', Auth::id())
            ->where('status', 'BORROWED')
            ->count();

        if ($activeBorrow >= 3) {
            return back()->withErrors('Maksimal 3 buku');
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'return_deadline' => now()->addDays(7),
            'status' => 'BORROWED',
        ]);

        $book->decrement('stock');

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    public function return(Book $book, Borrowing $borrowing)
    {
        $this->authorize('return', $borrowing);

        $borrowing->update([
            'status' => 'RETURNED',
            'returned_at' => now(),
        ]);

        $borrowing->book->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}
