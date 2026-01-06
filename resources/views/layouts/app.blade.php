<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Aplikasi BK Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3094/3094839.png">
</head>
<body class="bg-gray-50 min-h-screen text-gray-900">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="flex flex-col w-64 bg-indigo-900 text-white shadow-xl transition-all duration-300">
            <div class="flex items-center justify-center h-20 border-b border-indigo-700">
                <h1 class="text-2xl font-extrabold tracking-wider">
                    @auth
                        @php $role = Auth::user()->role ?? ''; @endphp
                        @if($role === 'siswa')
                            Halo Siswa
                        @else
                            BK ADMIN
                        @endif
                    @else
                        BK ADMIN
                    @endauth
                </h1>
            </div>

            <nav class="flex-grow p-4 space-y-2">
                @auth
                    @php $role = Auth::user()->role ?? ''; @endphp
                    @if($role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l-7-7-7 7m14 0v10a1 1 0 01-1 1h-3m-6 0h-2M5 20h14a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v12a1 1 0 001 1z"></path></svg>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-700' : '' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l-7-7-7 7m14 0v10a1 1 0 01-1 1h-3m-6 0h-2M5 20h14a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v12a1 1 0 001 1z"></path></svg>
                            <span>Dashboard</span>
                        </a>
                    @endif
                @endauth

                <a href="{{ route('admin.siswas.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors {{ request()->routeIs('admin.siswas.*') ? 'bg-indigo-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2h-.09a4.52 4.52 0 00-3.92-3.834M12 9a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                    <span>Data Siswa</span>
                </a>

                <a href="{{ route('admin.kasus.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors {{ request()->routeIs('admin.kasus.*') ? 'bg-indigo-700' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span>Catatan Kasus</span>
                </a>

                @php $role = Auth::user()->role ?? ''; @endphp
                @if($role === 'admin')
                    <a href="{{ route('admin.konseling.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors {{ request()->routeIs('admin.konseling.*') ? 'bg-indigo-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Konseling</span>
                    </a>
                @else
                    <a href="{{ route('siswa.konseling.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors {{ request()->routeIs('siswa.konseling.*') ? 'bg-indigo-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Pengajuan Konseling</span>
                    </a>
                    <a href="{{ route('siswa.konseling.history') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors {{ request()->routeIs('siswa.konseling.history') ? 'bg-indigo-700' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Riwayat Konseling</span>
                    </a>
                @endif
            </nav>

            <div class="p-4 border-t border-indigo-700">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center p-3 rounded-lg text-red-300 hover:bg-indigo-700 hover:text-red-100 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Main Content area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="flex items-center justify-between h-20 bg-white border-b shadow-sm px-6">
                <div class="flex items-center gap-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/3094/3094839.png" alt="Logo" class="w-8 h-8">
                    <a class="font-semibold text-lg" href="{{ route('home') }}">Aplikasi BK</a>
                </div>

                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-purple-600 text-white rounded-md">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 border border-purple-600 rounded-md">Daftar</a>
                    @else
                        @php $role = Auth::user()->role ?? ''; @endphp
                        @if($role === 'siswa')
                            <div class="text-gray-700">Halo Siswa</div>
                            <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=S&background=random" alt="Avatar-Siswa">
                        @elseif($role === 'admin')
                            <div class="text-gray-700">Halo, Admin BK!</div>
                            <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name=BK&background=random" alt="Avatar-Admin">
                        @else
                            <div class="text-gray-700">Halo, {{ Auth::user()->name ?? Auth::user()->email }}</div>
                            <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? Auth::user()->email) }}&background=random" alt="Avatar">
                        @endif
                    @endguest
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>