<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function store(StoreBookRequest $request)
    {
        Book::create($request->validated());
        return back()->with('success', 'Buku berhasil ditambahkan');
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return back()->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success', 'Buku berhasil dihapus');
    }
}
