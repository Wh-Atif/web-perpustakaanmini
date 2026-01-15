<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->keyword) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->category) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        $borrowings = $query->latest()->paginate(10);

        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'status' => 'required|in:BORROWED,RETURNED',
        ]);

        $borrowing->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status transaksi diperbarui.');
    }
}
