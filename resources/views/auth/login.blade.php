<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Bimbingan Konseling</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-lg">
        <div class="md:flex">
            <div class="p-8 space-y-6">
                <div class="text-center">
                    <div class="flex items-center justify-center text-5xl text-indigo-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>

                    <h1 class="text-3xl font-extrabold text-gray-900">Selamat Datang</h1>
                    <p class="mt-2 text-sm text-gray-500">Masuk ke Sistem Informasi Bimbingan Konseling</p>
                </div>

                @if (session('status'))
                    <div class="p-3 bg-green-100 text-green-700 rounded-lg text-center text-sm" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email atau Username</label>
                        <input type="text" id="email" name="email" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                               placeholder="Masukkan email atau username" value="{{ old('email') }}">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out"
                               placeholder="Masukkan password Anda">
                        @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-sm">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Lupa Password?</a>
                            @endif
                        </div>
                        <div class="text-sm">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out transform hover:scale-[1.01]">
                            MASUK
                        </button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="p-3 bg-red-100 text-red-700 rounded-lg text-center text-sm" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="mt-2 text-center text-sm">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">Daftar</a>
                </div>

                <p class="mt-6 text-center text-xs text-gray-400">&copy; 2024 Aplikasi BK Sekolah.</p>
            </div>
        </div>
    </div>
</body>
</html>