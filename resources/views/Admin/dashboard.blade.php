@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
    <p class="text-gray-600">Selamat datang kembali, Administrator.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                <i class="fas fa-book fa-2x"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Buku</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalBooks }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Anggota Terdaftar</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                <i class="fas fa-hand-holding-heart fa-2x"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Sedang Dipinjam</p>
                <p class="text-2xl font-bold text-gray-800">{{ $activeBorrowings }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                <i class="fas fa-exclamation-triangle fa-2x"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Jatuh Tempo</p>
                <p class="text-2xl font-bold text-gray-800">{{ $overdueCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h3>
    <div class="flex gap-4">
        <a href="{{ route('admin.books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i> Tambah Buku Baru
        </a>
        <a href="{{ route('admin.borrowings.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
            <i class="fas fa-list mr-2"></i> Cek Peminjaman
        </a>
    </div>
</div>
@endsection