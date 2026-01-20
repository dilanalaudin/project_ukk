@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="w-full">

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
         <div>
            <h1 class="text-2xl font-bold text-slate-800">Selamat Datang, Admin!</h1>
            <p class="text-slate-500 mt-1">Berikut adalah ringkasan aktivitas BK hari ini.</p>
         </div>
         <div class="flex gap-2">
            <span class="px-3 py-1 bg-white text-slate-600 rounded-md text-sm border font-medium shadow-sm">{{ now()->format('d M Y') }}</span>
         </div>
    </div>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-indigo-50 p-3 rounded-lg text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2h-.09a4.52 4.52 0 00-3.92-3.834M12 9a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">Total</span>
            </div>
            <p class="text-slate-500 text-sm font-medium">Total Siswa</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($totalSiswa ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-amber-50 p-3 rounded-lg text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Bulan Ini</span>
            </div>
            <p class="text-slate-500 text-sm font-medium">Kasus Baru</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($kasusBulanIni ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-red-50 p-3 rounded-lg text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded-full">Alert</span>
            </div>
            <p class="text-slate-500 text-sm font-medium">Pelanggaran Berat</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($pelanggaranBerat ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-emerald-50 p-3 rounded-lg text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Jadwal</span>
            </div>
            <p class="text-slate-500 text-sm font-medium">Konseling Terjadwal</p>
            <p class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($konselingTerjadwal ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Aktivitas Kasus Terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Aktivitas Kasus Terbaru</h3>
                <a href="{{ route('admin.kasus.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">Siswa</th>
                            <th class="px-6 py-4 bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kasus</th>
                            <th class="px-6 py-4 bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($todayKasus ?? [] as $k)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                       <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs mr-3">
                                            {{ substr($k->siswa->nama_lengkap ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-slate-900">{{ $k->siswa->nama_lengkap ?? 'N/A' }}</p>
                                            <p class="text-xs text-slate-500">{{ $k->siswa->kelas ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-700">{{ $k->jenis }}</p>
                                    <span class="text-xs text-slate-500">Severity: {{ ucfirst($k->severity) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $k->status === 'selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($k->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $k->tanggal?->format('d M') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                        <p>Belum ada aktivitas kasus hari ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Visi Misi Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 h-fit">
             <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Visi Misi BK</h3>
                <a href="{{ route('admin.visi-misi.index') }}" class="p-1 rounded-md hover:bg-slate-100 text-slate-400 hover:text-indigo-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </a>
            </div>
            
            @php $visiMisi = \App\Models\VisiMisi::first(); @endphp
            
            <div class="p-6">
                <div class="mb-6">
                    <h4 class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">Visi</h4>
                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-100">
                         <p class="text-slate-700 text-sm italic">{{ $visiMisi->visi ?? 'Belum diisi' }}</p>
                    </div>
                </div>
                <div>
                     <h4 class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-2">Misi</h4>
                     <ul class="space-y-2">
                        @if($visiMisi && $visiMisi->misi)
                             <li class="flex gap-3 text-sm text-slate-600">
                                <span class="mt-1.5 w-1.5 h-1.5 bg-indigo-400 rounded-full flex-shrink-0"></span>
                                <span class="whitespace-pre-wrap">{{ $visiMisi->misi }}</span>
                             </li>
                        @else
                             <li class="text-sm text-slate-500 italic">Belum diisi</li>
                        @endif
                     </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
