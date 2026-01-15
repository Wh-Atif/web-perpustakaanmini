@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        
        <div class="bg-indigo-600 p-6 text-center">
            <h2 class="text-3xl font-bold text-white">Buat Akun</h2>
            <p class="text-indigo-200 mt-2 text-sm">Bergabung menjadi anggota perpustakaan</p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-5">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" id="name" 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors
                            @error('name') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror" 
                            placeholder="Contoh: Budi Santoso" 
                            value="{{ old('name') }}" 
                            required autofocus>
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors
                            @error('email') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror" 
                            placeholder="nama@email.com" 
                            value="{{ old('email') }}" 
                            required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors
                            @error('password') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror" 
                            placeholder="Minimal 8 karakter" 
                            required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Ulangi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-check-circle text-gray-400"></i>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                            placeholder="Ketik ulang password" 
                            required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 shadow-md transition transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center border-t border-gray-100 pt-4">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-bold hover:underline">
                        Login disini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection