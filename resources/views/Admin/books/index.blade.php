@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Buku</h2>
        
        <a href="{{ route('admin.books.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow transition flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Buku
        </a>
    </div>

    <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
        <form action="{{ route('admin.books.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            
            <div class="w-full md:w-1/4">
                <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700" onchange="this.form.submit()">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-3/4 flex">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari Judul atau Pengarang..." class="w-full px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded-r-lg hover:bg-gray-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            @if(request('category_id') || request('keyword'))
                <a href="{{ route('admin.books.index') }}" class="px-4 py-2 text-red-500 hover:text-red-700 font-bold flex items-center justify-center">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 border-b">Judul</th>
                    <th class="p-3 border-b">Kategori</th>
                    <th class="p-3 border-b">Pengarang</th>
                    <th class="p-3 border-b text-center">Tahun</th>
                    <th class="p-3 border-b text-center">Stok</th>
                    <th class="p-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr class="hover:bg-gray-50 border-b">
                    <td class="p-3 font-medium">{{ $book->title }}</td>
                    <td class="p-3">
                        <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                            {{ $book->category->name ?? '-' }}
                        </span>
                    </td>
                    <td class="p-3">{{ $book->author }}</td>
                    <td class="p-3 text-center">{{ $book->year }}</td>
                    <td class="p-3 text-center">
                        <span class="{{ $book->stock > 0 ? 'text-green-600 font-bold' : 'text-red-500 font-bold' }}">
                            {{ $book->stock }}
                        </span>
                    </td>
                    <td class="p-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="text-yellow-500 hover:text-yellow-600 border border-yellow-500 hover:bg-yellow-50 px-3 py-1 rounded text-sm transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 border border-red-500 hover:bg-red-50 px-3 py-1 rounded text-sm transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">
                        <div class="mb-2"><i class="fas fa-search fa-2x"></i></div>
                        Buku tidak ditemukan dengan filter tersebut.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $books->withQueryString()->links('pagination::tailwind') }}
    </div>
</div>
@endsection