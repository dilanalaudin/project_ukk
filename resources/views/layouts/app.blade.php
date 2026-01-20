<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Aplikasi BK Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3094/3094839.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>

    @livewireStyles
</head>
<body class="bg-slate-100 min-h-screen text-slate-800 antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="flex flex-col w-64 bg-slate-900 text-slate-300 transition-all duration-300 border-r border-slate-800">
            <div class="flex items-center justify-center h-20 border-b border-slate-800 bg-slate-900">
                <div class="flex items-center gap-3">
                     <div class="bg-indigo-600 p-2 rounded-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/3094/3094839.png" alt="Logo" class="w-6 h-6 filter brightness-0 invert">
                     </div>
                     <span class="text-xl font-bold text-white tracking-wide">Aplikasi BK</span>
                </div>
            </div>

            <nav class="flex-grow p-4 space-y-2 overflow-y-auto custom-scrollbar">
                @auth
                    @php $role = Auth::user()->role ?? ''; @endphp
                    
                    <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Menu Utama</p>

                    @if($role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                             <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    @endif
                @endauth

                @php $role = Auth::user()->role ?? ''; @endphp
                @if($role === 'admin')
                <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Administrasi</p>
                @endif

                <a href="{{ route('admin.siswas.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.siswas.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.siswas.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="font-medium">{{ $role === 'admin' ? 'Data Siswa' : 'Data Diri' }}</span>
                </a>

                @php $role = Auth::user()->role ?? ''; @endphp
                <a href="{{ $role === 'admin' ? route('admin.kasus.index') : route('siswa.kasus.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ ($role === 'admin' ? request()->routeIs('admin.kasus.*') : request()->routeIs('siswa.kasus.*')) ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3 {{ ($role === 'admin' ? request()->routeIs('admin.kasus.*') : request()->routeIs('siswa.kasus.*')) ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="font-medium">Catatan Kasus</span>
                </a>

                <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Bimbingan Konseling</p>

                @php $role = Auth::user()->role ?? ''; @endphp
                @if($role === 'admin')
                    <a href="{{ route('admin.konseling.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.konseling.index') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                       <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.konseling.index') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        <span class="font-medium">Konseling</span>
                    </a>
                    <a href="{{ route('admin.konseling.riwayat') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.konseling.riwayat') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.konseling.riwayat') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">Riwayat</span>
                    </a>
                @else
                    <a href="{{ route('siswa.konseling.index') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('siswa.konseling.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('siswa.konseling.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        <span class="font-medium">Pengajuan</span>
                    </a>
                    <a href="{{ route('siswa.konseling.history') }}" class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group {{ request()->routeIs('siswa.konseling.history') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('siswa.konseling.history') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">Riwayat</span>
                    </a>
                @endif
            </nav>

            <div class="px-4 py-4 border-t border-slate-800 bg-slate-900">
                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center py-2.5 px-4 rounded-lg bg-slate-800 text-slate-300 hover:bg-red-600 hover:text-white transition-all duration-200 group">
                            <svg class="w-5 h-5 mr-2 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="font-medium text-sm">Logout</span>
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Main Content area -->
        <div class="flex-1 flex flex-col overflow-hidden bg-slate-100 relative">
             <!-- Top Navbar -->
            <header class="flex items-center justify-between h-16 bg-white border-b border-gray-200 shadow-sm px-6 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button class="text-slate-500 hover:text-indigo-600 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-lg font-bold text-gray-800 tracking-tight">
                         @yield('title')
                    </h2>
                </div>

                <div class="flex items-center gap-6">
                    @guest
                        <div class="flex gap-2">
                             <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">Login</a>
                             <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">Daftar</a>
                        </div>
                    @else
                        <!-- Notification Bell (Assuming inserted previously) -->
                        <livewire:notification-bell />

                        <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                             <div class="text-right hidden sm:block">
                                <div class="text-sm font-semibold text-gray-800 leading-tight">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 font-medium">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                            <img class="w-9 h-9 rounded-full object-cover border-2 border-indigo-100 p-0.5" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff&size=128" 
                                 alt="Avatar">
                        </div>
                    @endguest
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-md shadow-sm">
                        <div class="flex">
                            <div class="py-1"><svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></div>
                            <div>{{ session('status') }}</div>
                        </div>
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-md shadow-sm">
                        <div class="flex">
                            <div class="py-1"><svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></div>
                            <div>{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded-md shadow-sm">
                         <div class="flex">
                            <div class="py-1"><svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div>{{ session('error') }}</div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <livewire:chatbot/>
    
    @livewireScripts
</body>
</html>