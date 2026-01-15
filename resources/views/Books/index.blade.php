@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <h1 class="text-3xl font-bold text-gray-800">Katalog Buku</h1>
    
    <form action="{{ route('books.index') }}" method="GET" class="w-full md:w-auto flex flex-col md:flex-row gap-2 shadow-sm">
        
        <select name="category_id" class="px-4 py-2 border border-gray-300 rounded-lg md:rounded-r-none focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white text-gray-700" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <div class="flex w-full md:w-64">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari judul..." class="w-full px-4 py-2 border-t border-b border-l border-gray-300 md:border-l-0 rounded-l-lg md:rounded-l-none focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700 transition">
                <i class="fas fa-search"></i>
            </button>
        </div>

    </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($books as $book)
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-gray-100 flex flex-col">
        <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
            <i class="fas fa-book fa-4x"></i>
        </div>
        
        <div class="p-5 flex-1 flex flex-col">
            <div class="mb-2">
                <span class="text-xs font-semibold uppercase tracking-wide text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">
                    {{ $book->category->name ?? 'Umum' }}
                </span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1 leading-tight">{{ Str::limit($book->title, 40) }}</h3>
            <p class="text-sm text-gray-600 mb-4">Oleh: {{ $book->author }} ({{ $book->year }})</p>
            
            <div class="mt-auto flex justify-between items-center border-t pt-4">
                <div class="text-sm">
                    Stok: 
                    @if($book->stock > 0)
                        <span class="font-bold text-green-600">{{ $book->stock }}</span>
                    @else
                        <span class="font-bold text-red-500">Habis</span>
                    @endif
                </div>

                @auth
                    @if(Auth::user()->role !== 'admin')
                        @if($book->stock > 0)
                            <form action="{{ route('borrowings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                                    Pinjam
                                </button>
                            </form>
                        @else
                            <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm cursor-not-allowed">
                                Full
                            </button>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-indigo-600 text-sm hover:underline">Login untuk pinjam</a>
                @endauth
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
        <div class="text-gray-400 text-5xl mb-4"><i class="fas fa-folder-open"></i></div>
        <p class="text-gray-500 text-lg">Tidak ada buku yang ditemukan.</p>
    </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $books->withQueryString()->links('pagination::tailwind') }}
</div>
@endsection