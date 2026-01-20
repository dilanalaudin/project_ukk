@extends('layouts.app')

@section('title', 'Dashboard - Siswa')

@section('content')
@section('content')
  <div class="w-full">
    
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-2xl p-6 shadow-lg mb-8 text-white">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
             <div>
                <h1 class="text-2xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-indigo-100 text-sm opacity-90">Selamat datang di Dashboard Siswa. Pantau aktivitas dan jadwal konselingmu di sini.</p>
             </div>
             
             <div class="flex gap-3">
                 <a href="{{ route('siswa.konseling.index') }}" class="px-4 py-2 bg-white text-indigo-700 rounded-lg text-sm font-semibold hover:bg-indigo-50 transition-colors shadow-sm">
                    + Ajukan Konseling
                 </a>
             </div>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-lg font-bold text-slate-800 mb-4">Ringkasan Aktivitas</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                 <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-50 p-3 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                 </div>
                 <p class="text-slate-500 text-sm font-medium">Jadwal Konsultasi</p>
                 <div class="flex justify-between items-end mt-1">
                    <p class="text-2xl font-bold text-slate-800">{{ $konselingTerjadwal ?? 0 }}</p>
                    <a href="{{ route('siswa.jadwals.index') }}" class="text-blue-600 text-xs font-semibold hover:underline">Lihat Detail →</a>
                 </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                 <div class="flex items-center justify-between mb-4">
                    <div class="bg-emerald-50 p-3 rounded-lg text-emerald-600">
                       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                 </div>
                 <p class="text-slate-500 text-sm font-medium">Catatan Konseling</p>
                  <div class="flex justify-between items-end mt-1">
                    <p class="text-2xl font-bold text-slate-800">{{ $catatanCount ?? 0 }}</p>
                    <a href="{{ route('siswa.notes.index') }}" class="text-emerald-600 text-xs font-semibold hover:underline">Lihat Detail →</a>
                 </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                     <div class="bg-amber-50 p-3 rounded-lg text-amber-600">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                     </div>
                </div>
                 <p class="text-slate-500 text-sm font-medium">Total Pelanggaran</p>
                 <p class="text-2xl font-bold text-slate-800 mt-1">{{ $kasusCount ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-red-50 p-3 rounded-lg text-red-600">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
                <p class="text-slate-500 text-sm font-medium">Total Poin</p>
                <p class="text-2xl font-bold text-red-600 mt-1">{{ $totalPoin ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Riwayat Pelanggaran --}}
        <div class="lg:col-span-2">
            @if($kasusList && count($kasusList) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800">Riwayat Pelanggaran</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jenis Pelanggaran</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tingkat</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Poin</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($kasusList as $kasus)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $kasus->jenis }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kasus->severity === 'berat' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ ucfirst($kasus->severity) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-red-500">{{ $kasus->poin }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kasus->status === 'selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($kasus->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $kasus->tanggal ? $kasus->tanggal->format('d M Y') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <p class="text-slate-500 text-center">Belum ada riwayat pelanggaran.</p>
            </div>
            @endif
        </div>

        {{-- Visi Misi Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 h-fit">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Visi Misi BK</h3>
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