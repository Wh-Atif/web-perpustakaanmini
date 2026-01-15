<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Kecil-kecilan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <nav class="bg-indigo-600 shadow-lg relative z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                
                <a href="{{ route('books.index') }}" class="text-white text-xl font-bold flex items-center gap-2">
                    <i class="fas fa-book-reader"></i> MiniLib
                </a>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('books.index') }}" class="text-indigo-100 hover:text-white transition font-medium">
                        Katalog Buku
                    </a>
                    
                    @auth
                        @if(Auth::user()->role === 'user')
                            <a href="{{ route('borrowings.index') }}" class="text-indigo-100 hover:text-white transition font-medium">
                                Peminjaman Saya
                            </a>
                        @endif

                        @can('admin-only')
                            <div class="relative group">
                                <button class="text-indigo-100 hover:text-white flex items-center font-medium focus:outline-none">
                                    Admin Menu <i class="fas fa-caret-down ml-1"></i>
                                </button>
                                <div class="absolute right-0 mt-0 w-48 bg-white rounded-md shadow-xl py-2 hidden group-hover:block">
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-500 hover:text-white">Dashboard</a>
                                    <a href="{{ route('admin.books.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-500 hover:text-white">Kelola Buku</a>
                                    <a href="{{ route('admin.borrowings.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-500 hover:text-white">Peminjaman</a>
                                </div>
                            </div>
                        @endcan
                    @endauth
                </div>

                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-white hover:text-indigo-200 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-full font-bold hover:bg-gray-100 transition shadow-sm text-sm">
                            Daftar
                        </a>
                    @else
                        <div class="hidden md:flex items-center text-indigo-200 text-sm mr-2">
                            Halo, {{ Auth::user()->name }}
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-sm transition shadow border border-red-500" title="Keluar">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="grow container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold"><i class="fas fa-exclamation-circle"></i> Perhatian:</p>
                <ul class="list-disc ml-5 mt-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="container mx-auto text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Mini Library. Made with Love.
        </div>
    </footer>

</body>
</html>