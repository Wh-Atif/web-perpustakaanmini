<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookUserController extends Controller
{
    /**
     * Menampilkan daftar buku (user)
     */
    public function index(Request $request)
    {
        $query = Book::query();

        // filter keyword judul
        if ($request->keyword) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        // filter kategori
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // hanya buku yang stoknya >= 0
        $books = $query->orderBy('title')->get();

        return view('books.user.index', compact('books'));
    }

    /**
     * Detail buku
     */
    public function show(Book $book)
    {
        return view('books.user.show', compact('book'));
    }
}
