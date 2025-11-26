@extends('layouts.app')

@section('title', 'Dashboard - Admin')

@section('content')
@auth
<div class="flex h-[calc(100vh-6rem)]">
    <div class="flex flex-col w-64 bg-indigo-900 text-white shadow-xl transition-all duration-300 rounded-lg overflow-hidden">
        <div class="flex items-center justify-center h-20 border-b border-indigo-700">
            <h1 class="text-2xl font-extrabold tracking-wider">BK ADMIN</h1>
        </div>

        <nav class="flex-grow p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg bg-indigo-700 hover:bg-indigo-600 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l-7-7-7 7m14 0v10a1 1 0 01-1 1h-3m-6 0h-2M5 20h14a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v12a1 1 0 001 1z"></path></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.siswas.index') }}" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2h-.09a4.52 4.52 0 00-3.92-3.834M12 9a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                <span>Data Siswa</span>
            </a>

            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span>Catatan Kasus</span>
            </a>

            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.405L4 17h5m6 0v2a3 3 0 11-6 0v-2"></path></svg>
                <span>Layanan BK</span>
            </a>
        </nav>

        <div class="p-4 border-t border-indigo-700">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center p-3 w-full justify-center rounded-lg text-red-300 hover:bg-indigo-700 hover:text-red-100 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 flex flex-col overflow-hidden ml-6">
        <header class="flex items-center justify-between h-20 bg-white border-b shadow-sm px-6 rounded-lg">
            <div class="text-xl font-semibold text-gray-800">Ringkasan Hari Ini</div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Halo, {{ Auth::user()->name ?? Auth::user()->email }}</span>
                <img class="w-10 h-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? Auth::user()->email) }}&background=random" alt="Avatar">
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard BK</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-indigo-500">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">1.250</p>
                    </div>
                    <svg class="w-10 h-10 text-indigo-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2h-.09a4.52 4.52 0 00-3.92-3.834M12 9a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-yellow-500">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kasus Bulan Ini</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">45</p>
                    </div>
                    <svg class="w-10 h-10 text-yellow-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-red-500">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Pelanggaran Berat</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">8</p>
                    </div>
                    <svg class="w-10 h-10 text-red-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg flex items-center justify-between border-l-4 border-green-500">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Konseling Terjadwal</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
                    </div>
                    <svg class="w-10 h-10 text-green-400 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M16 12h.01M21 7v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2z"></path></svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Aktivitas Kasus Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kasus</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rizky Firmansyah</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">XII IPA 1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Bolos (Ringan)</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Nov 2025</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Siti Aisyah</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">X IPS 3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Perundungan (Berat)</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Selesai</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12 Nov 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@else
<div class="bg-white rounded-lg p-6 shadow text-center">
    <h2 class="text-xl font-semibold">Silakan login untuk melihat Dashboard</h2>
    <a href="{{ route('login') }}" class="mt-2 inline-block px-4 py-2 bg-purple-600 text-white rounded">Login</a>
</div>
@endauth
@endsection