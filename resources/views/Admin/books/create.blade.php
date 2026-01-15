@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Buku Baru</h2>
        <a href="{{ route('admin.books.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.books.store') }}" method="POST">
        @csrf
        
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Buku</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('title') border-red-500 @enderror" placeholder="Masukkan judul buku">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Pengarang</label>
                <input type="text" name="author" value="{{ old('author') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('author') border-red-500 @enderror">
                @error('author') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Tahun Terbit</label>
                <input type="number" name="year" value="{{ old('year') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('year') border-red-500 @enderror">
                @error('year') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('category_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Stok Awal</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('stock') border-red-500 @enderror">
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg">
                <i class="fas fa-save mr-2"></i> Simpan Buku
            </button>
        </div>
    </form>
</div>
@endsection