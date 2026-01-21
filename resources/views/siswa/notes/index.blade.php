@extends('layouts.app')

@section('title', 'Catatan Konseling - Siswa')

@section('content')
<div class="w-full">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-800">Catatan Konseling</h1>
        <p class="text-slate-500 mt-1">Lihat catatan dan hasil konseling dari sesi Anda</p>
    </div>

    @if ($konselings->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12">
            <div class="text-center">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-slate-500 font-medium">Belum ada catatan konseling</p>
                <p class="text-slate-400 text-sm mt-1">Catatan akan muncul setelah sesi konseling selesai</p>
            </div>
        </div>
    @else
        <div class="grid gap-4">
            @foreach ($konselings as $note)
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">
                                            {{ \Illuminate\Support\Carbon::parse($note->tanggal)->format('l, d M Y') }}
                                        </p>
                                        <h3 class="text-lg font-semibold text-slate-800 capitalize">{{ $note->topik ?? 'Konsultasi' }}</h3>
                                    </div>
                                </div>

                                <div class="mt-4 space-y-3">
                                    @if($note->ringkasan_masalah)
                                        <div>
                                            <p class="text-xs font-semibold text-slate-500 uppercase">Ringkasan Masalah</p>
                                            <p class="text-sm text-slate-700 mt-1">{{ Str::limit($note->ringkasan_masalah, 150) }}</p>
                                        </div>
                                    @endif

                                    @if($note->solusi)
                                        <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-3">
                                            <p class="text-xs font-semibold text-emerald-700 uppercase mb-1">Hasil & Solusi</p>
                                            <p class="text-sm text-emerald-900">{{ Str::limit($note->solusi, 200) }}</p>
                                        </div>
                                    @endif

                                    @if($note->jadwal_berikutnya)
                                        <div class="flex items-center gap-2 text-sm">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-slate-600">Jadwal Berikutnya: <strong>{{ \Illuminate\Support\Carbon::parse($note->jadwal_berikutnya)->format('d M Y') }}</strong></span>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3 mt-4 pt-4 border-t border-slate-100">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($note->status === 'proses') bg-blue-100 text-blue-800
                                        @elseif($note->status === 'disetujui' || $note->status === 'selesai') bg-emerald-100 text-emerald-800
                                        @elseif($note->status === 'ditolak') bg-red-100 text-red-800
                                        @else bg-slate-100 text-slate-800 @endif">
                                        {{ ucfirst($note->status) }}
                                    </span>
                                </div>
                            </div>

                            <div>
                                <a href="{{ route('siswa.konseling.show', $note->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition-colors text-sm whitespace-nowrap">
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
