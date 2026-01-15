<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category; 
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all(); 

        $query = Book::with('category'); 

        if ($request->keyword) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('author', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $books = $query->orderBy('title')->paginate(12);

        return view('books.index', compact('books', 'categories'));
    }
    
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}