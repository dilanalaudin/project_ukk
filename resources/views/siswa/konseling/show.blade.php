@extends('layouts.app')

@section('title', 'Detail Pengajuan Konseling')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('siswa.konseling.index') }}" class="text-indigo-600 hover:text-indigo-800">← Kembali</a>
    </div>

    <h1 class="text-2xl font-bold mb-4">Detail Pengajuan Konseling</h1>

    <div class="bg-white p-6 rounded-lg shadow mb-4">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                <p class="text-lg font-semibold">{{ $konseling->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Konseling</p>
                <p class="text-lg font-semibold">{{ $konseling->tanggal?->format('d M Y') ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Topik</p>
                <p class="text-lg font-semibold">{{ ucfirst($konseling->topik ?? 'N/A') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                    {{ $konseling->status === 'disetujui' ? 'bg-green-100 text-green-800' : ($konseling->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                    {{ ucfirst($konseling->status) }}
                </span>
            </div>
        </div>

        <div class="mb-6 pb-6 border-b">
            <p class="text-sm text-gray-500 mb-2">Ringkasan Masalah</p>
            <p class="text-gray-700">{{ $konseling->ringkasan_masalah ?? 'Belum ada' }}</p>
        </div>

        @if($konseling->solusi)
        <div class="mb-6 pb-6 border-b bg-blue-50 p-4 rounded">
            <p class="text-sm text-gray-500 mb-2">Solusi / Tindak Lanjut (dari BK)</p>
            <p class="text-gray-700">{{ $konseling->solusi }}</p>
        </div>
        @endif

        @if($konseling->jadwal_berikutnya)
        <div>
            <p class="text-sm text-gray-500 mb-2">Jadwal Temu Berikutnya</p>
            <p class="text-lg font-semibold text-indigo-600">{{ $konseling->jadwal_berikutnya->format('d M Y') }}</p>
        </div>
        @endif
    </div>

    @if($konseling->status === 'proses')
    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
        <p class="text-sm text-yellow-800">⏳ Pengajuan Anda sedang ditinjau oleh BK. Silakan tunggu notifikasi.</p>
    </div>
    @elseif($konseling->status === 'ditolak')
    <div class="bg-red-50 border border-red-200 p-4 rounded-lg">
        <p class="text-sm text-red-800">❌ Pengajuan ditolak. Silakan hubungi BK untuk informasi lebih lanjut.</p>
    </div>
    @elseif($konseling->status === 'disetujui')
    <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
        <p class="text-sm text-green-800">✅ Pengajuan disetujui! Konseling akan dilaksanakan sesuai jadwal yang telah ditentukan.</p>
    </div>
    @endif
</div>
@endsection
