<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Aplikasi BK Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3094/3094839.png">
    <style>
      /* Beberapa style dasar supaya view lama tetap tampil baik */
      body { font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-900">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="https://cdn-icons-png.flaticon.com/512/3094/3094839.png" alt="Logo" class="w-8 h-8">
                <a class="font-semibold text-lg" href="{{ route('home') }}">Aplikasi BK</a>
            </div>

            <div class="flex items-center gap-3">
                <a class="hidden md:inline text-sm text-gray-600 hover:text-gray-900" href="#fitur">Fitur</a>

                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-purple-600 text-white rounded-md">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 border border-purple-600 rounded-md">Daftar</a>
                @else
                    @if ((Auth::user()->role ?? '') === 'admin')
                        <a href="{{ route('admin.siswas.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Admin Panel</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Dashboard</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 ml-2 border rounded-md bg-white text-sm">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center text-sm text-gray-500 py-6">
        &copy; {{ date('Y') }} Aplikasi BK Sekolah
    </footer>
</body>
</html>