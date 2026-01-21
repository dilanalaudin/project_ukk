@extends('layouts.app')

@section('title', 'Detail Konseling')

@section('content')
<div class="w-full max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="javascript:history.back()" class="text-indigo-600 hover:text-indigo-700 font-semibold flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Header Section --}}
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2 capitalize">{{ $konseling->topik ?? 'Konsultasi Umum' }}</h1>
                    <p class="text-indigo-100">Tanggal: {{ $konseling->tanggal?->format('l, d M Y') ?? 'Belum dijadwalkan' }}</p>
                </div>
                <div class="text-right">
                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full 
                        @if($konseling->status === 'proses') bg-blue-200 text-blue-900
                        @elseif($konseling->status === 'disetujui' || $konseling->status === 'selesai') bg-emerald-200 text-emerald-900
                        @elseif($konseling->status === 'ditolak') bg-red-200 text-red-900
                        @else bg-slate-200 text-slate-900 @endif">
                        {{ ucfirst($konseling->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">
            {{-- Info Dasar --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-50 p-4 rounded-lg">
                    <p class="text-xs font-semibold text-slate-500 uppercase">Tanggal Pengajuan</p>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $konseling->created_at->format('d M Y') }}</p>
                    <p class="text-xs text-slate-500">{{ $konseling->created_at->format('H:i') }}</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-lg">
                    <p class="text-xs font-semibold text-slate-500 uppercase">Topik Konseling</p>
                    <p class="text-lg font-semibold text-slate-800 mt-1 capitalize">{{ $konseling->topik ?? '-' }}</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-lg">
                    <p class="text-xs font-semibold text-slate-500 uppercase">Tipe</p>
                    <p class="text-lg font-semibold text-slate-800 mt-1">
                        @if($konseling->type === 'jadwal')
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">Jadwal</span>
                        @else
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded text-sm">Catatan</span>
                        @endif
                    </p>
                </div>
                <div class="bg-slate-50 p-4 rounded-lg">
                    <p class="text-xs font-semibold text-slate-500 uppercase">Status Perubahan</p>
                    <p class="text-lg font-semibold text-slate-800 mt-1">{{ $konseling->updated_at->format('d M Y') }}</p>
                </div>
            </div>

            <hr class="border-slate-200">

            {{-- Ringkasan Masalah --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-800 mb-3">Ringkasan Masalah</h3>
                @if($konseling->ringkasan_masalah)
                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                        <p class="text-slate-700 whitespace-pre-wrap">{{ $konseling->ringkasan_masalah }}</p>
                    </div>
                @else
                    <p class="text-slate-500 italic">Belum ada ringkasan masalah</p>
                @endif
            </div>

            {{-- Tanggapan Admin --}}
            @if($konseling->tanggapan)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-blue-900 mb-1">Tanggapan dari BK</h4>
                        <p class="text-blue-800 whitespace-pre-wrap">{{ $konseling->tanggapan }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Solusi/Tindak Lanjut --}}
            @if($konseling->solusi)
            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                <div class="flex gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-emerald-900 mb-1">Hasil & Solusi / Tindak Lanjut</h4>
                        <p class="text-emerald-800 whitespace-pre-wrap">{{ $konseling->solusi }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Jadwal Berikutnya --}}
            @if($konseling->jadwal_berikutnya)
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-amber-900">Jadwal Temu Berikutnya</p>
                        <p class="text-lg font-bold text-amber-900">{{ $konseling->jadwal_berikutnya->format('l, d M Y') }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Status Messages --}}
            @if($konseling->status === 'proses')
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold text-blue-900">Sedang Diproses</p>
                    <p class="text-sm text-blue-800">Pengajuan Anda sedang ditinjau oleh BK. Silakan tunggu notifikasi selanjutnya.</p>
                </div>
            </div>
            @elseif($konseling->status === 'ditolak')
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex gap-3">
                <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold text-red-900">Pengajuan Ditolak</p>
                    <p class="text-sm text-red-800">Pengajuan konseling Anda tidak dapat disetujui. Silakan hubungi BK untuk informasi lebih lanjut.</p>
                </div>
            </div>
            @elseif($konseling->status === 'disetujui' || $konseling->status === 'selesai')
            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4 flex gap-3">
                <svg class="w-6 h-6 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold text-emerald-900">Disetujui {{ $konseling->status === 'selesai' ? '& Selesai' : '' }}</p>
                    <p class="text-sm text-emerald-800">
                        @if($konseling->status === 'selesai')
                            Konseling telah selesai. Terima kasih telah mengikuti sesi konseling dengan BK.
                        @else
                            Pengajuan Anda telah disetujui! Konseling akan dilaksanakan sesuai jadwal yang telah ditentukan.
                        @endif
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
