<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register - Aplikasi Bimbingan Konseling</title>
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
                    <h1 class="text-3xl font-extrabold text-gray-900">Daftar Akun</h1>
                    <p class="mt-2 text-sm text-gray-500">Buat akun untuk mengakses sistem</p>
                </div>

                <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input id="name" name="name" required type="text" value="{{ old('name') }}"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" required type="email" value="{{ old('email') }}"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" required type="password"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" required type="password"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            DAFTAR
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

                <p class="mt-6 text-center text-xs text-gray-400">&copy; 2024 Aplikasi BK Sekolah.</p>
                <p class="mt-3 text-center text-sm text-gray-500">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600">Masuk</a></p>
            </div>
        </div>
    </div>
</body>
</html>