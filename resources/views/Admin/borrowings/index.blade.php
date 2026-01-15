@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Peminjaman</h2>
        
        <div class="flex space-x-2">
            <a href="{{ route('admin.borrowings.index', ['status' => 'BORROWED']) }}" class="px-3 py-1 text-sm rounded-full {{ request('status') == 'BORROWED' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Sedang Dipinjam</a>
            <a href="{{ route('admin.borrowings.index', ['status' => 'RETURNED']) }}" class="px-3 py-1 text-sm rounded-full {{ request('status') == 'RETURNED' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Riwayat Kembali</a>
            <a href="{{ route('admin.borrowings.index') }}" class="px-3 py-1 text-sm rounded-full {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">Semua</a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs font-bold tracking-wider">
                    <th class="p-4">Peminjam</th>
                    <th class="p-4">Buku</th>
                    <th class="p-4">Tgl Pinjam</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse($borrowings as $borrow)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        <div class="font-bold text-gray-900">{{ $borrow->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $borrow->user->email }}</div>
                    </td>
                    <td class="p-4 text-gray-700">{{ $borrow->book->title }}</td>
                    <td class="p-4 text-gray-600">
                        {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y') }}
                        <br>
                        <span class="text-xs text-gray-400">Tenggat: {{ \Carbon\Carbon::parse($borrow->return_deadline)->format('d/m/Y') }}</span>
                    </td>
                    <td class="p-4">
                        @if($borrow->status == 'BORROWED')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Dipinjam
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Dikembalikan
                            </span>
                            <div class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($borrow->return_date)->format('d/m/Y') }}</div>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        @if($borrow->status == 'BORROWED')
                            <form action="{{ route('admin.borrowings.update', $borrow->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pengembalian buku ini? Stok akan bertambah.');">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="RETURNED">
                                <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-green-600 shadow-sm transition">
                                    <i class="fas fa-check mr-1"></i> Proses Kembali
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400"><i class="fas fa-check-circle"></i> Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $borrowings->withQueryString()->links('pagination::tailwind') }}
    </div>
</div>
@endsection