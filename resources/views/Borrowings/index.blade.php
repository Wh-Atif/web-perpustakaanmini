@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Buku yang Sedang Dipinjam</h2>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-indigo-50 text-indigo-900 uppercase text-xs font-semibold">
                    <th class="p-4">Judul Buku</th>
                    <th class="p-4">Tanggal Pinjam</th>
                    <th class="p-4">Tenggat Waktu</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($borrowings as $borrow)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium text-gray-900">{{ $borrow->book->title }}</td>
                    <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d M Y') }}</td>
                    <td class="p-4">
                        @php
                            $deadline = \Carbon\Carbon::parse($borrow->return_deadline);
                            $isOverdue = now()->gt($deadline) && $borrow->status == 'BORROWED';
                        @endphp
                        <span class="{{ $isOverdue ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                            {{ $deadline->format('d M Y') }}
                        </span>
                        @if($isOverdue)
                            <span class="text-xs text-red-500 block">Terlambat!</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-bold">
                            {{ $borrow->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        Anda belum meminjam buku apapun saat ini. <a href="{{ route('books.index') }}" class="text-indigo-600 hover:underline">Cari buku?</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection