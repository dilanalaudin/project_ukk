@extends('layouts.app')

@section('title', 'Detail Pengajuan Konseling')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('admin.konseling.index') }}" class="text-indigo-600 hover:text-indigo-800">← Kembali</a>
    </div>

    <h1 class="text-2xl font-bold mb-4">Detail Pengajuan Konseling</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-sm text-gray-500">Siswa</p>
                <p class="text-lg font-semibold">{{ $konseling->siswa->nama_lengkap ?? 'N/A' }}</p>
                <p class="text-sm text-gray-600">{{ $konseling->siswa->kelas ?? 'N/A' }}</p>
                <p class="text-sm text-gray-600">{{ $konseling->siswa->jurusan ?? 'N/A' }}</p>
                <p class="text-sm text-gray-600">{{ $konseling->siswa->jenis_kelamin === 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <x-model-status-badge :status="$konseling->status" class="px-3 py-1 text-sm" />
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                <p class="text-lg font-semibold">{{ $konseling->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Konseling</p>
                <p class="text-lg font-semibold">{{ $konseling->tanggal?->format('d M Y') ?? '-' }}</p>
            </div>
        </div>

        <div class="mb-6 pb-6 border-b">
            <p class="text-sm text-gray-500 mb-2">Topik</p>
            <p class="text-lg font-semibold">{{ ucfirst($konseling->topik ?? 'N/A') }}</p>
        </div>

        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-2">Ringkasan Masalah (dari Siswa)</p>
            <p class="text-gray-700">{{ $konseling->ringkasan_masalah ?? 'Belum ada' }}</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.konseling.edit', $konseling) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Proses & Catat Hasil</a>
            <a href="{{ route('admin.konseling.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Kembali</a>
        </div>
    </div>
</div>
@endsection
