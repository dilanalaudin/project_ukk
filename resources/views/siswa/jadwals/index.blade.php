@extends('layouts.app')

@section('title', 'Jadwal Konsultasi - Siswa')

@section('content')
<div class="w-full">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-800">Jadwal Konsultasi</h1>
        <p class="text-slate-500 mt-1">Kelola jadwal konsultasi Anda dengan BK</p>
    </div>

    @if ($jadwals->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12">
            <div class="text-center">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-slate-500 font-medium">Belum ada jadwal konsultasi</p>
                <p class="text-slate-400 text-sm mt-1">Ajukan jadwal konsultasi untuk memulai</p>
                <a href="{{ route('siswa.konseling.create') }}" class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors">
                    + Ajukan Konsultasi
                </a>
            </div>
        </div>
    @else
        <div class="grid gap-4">
            @foreach ($jadwals as $jadwal)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 font-semibold">
                                        {{ \Illuminate\Support\Carbon::parse($jadwal->tanggal)->format('d') }}
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">
                                            {{ \Illuminate\Support\Carbon::parse($jadwal->tanggal)->format('l, d M Y') }}
                                        </p>
                                        <h3 class="text-lg font-semibold text-slate-800 capitalize">{{ $jadwal->topik ?? 'Konsultasi Umum' }}</h3>
                                    </div>
                                </div>
                                
                                <div class="mt-4 space-y-2">
                                    @if($jadwal->ringkasan_masalah)
                                        <div>
                                            <p class="text-xs font-semibold text-slate-500 uppercase">Ringkasan Masalah</p>
                                            <p class="text-sm text-slate-700 mt-1 line-clamp-2">{{ $jadwal->ringkasan_masalah }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3 mt-4 pt-4 border-t border-slate-100">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($jadwal->status === 'proses') bg-blue-100 text-blue-800
                                        @elseif($jadwal->status === 'disetujui') bg-emerald-100 text-emerald-800
                                        @elseif($jadwal->status === 'ditolak') bg-red-100 text-red-800
                                        @else bg-slate-100 text-slate-800 @endif">
                                        {{ ucfirst($jadwal->status) }}
                                    </span>
                                    
                                    @if($jadwal->solusi)
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                            Ada Hasil Konseling
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <a href="{{ route('siswa.konseling.show', $jadwal->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors text-sm whitespace-nowrap">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
