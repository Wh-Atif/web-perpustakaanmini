@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Edit Buku</h2>
        <a href="{{ route('admin.books.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i> Batal
        </a>
    </div>

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Buku</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Pengarang</label>
                <input type="text" name="author" value="{{ old('author', $book->author) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit</label>
                <input type="number" name="year" value="{{ old('year', $book->year) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Stok Saat Ini</label>
                <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg">
                <i class="fas fa-save mr-2"></i> Perbarui Data
            </button>
        </div>
    </form>
</div>
@endsection