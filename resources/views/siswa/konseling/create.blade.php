@extends('layouts.app')

@section('title', 'Ajukan Konseling')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Ajukan Konseling</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('siswa.konseling.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Tanggal Konseling</label>
                <input type="date" name="tanggal" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                @error('tanggal') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Topik Konseling</label>
                <select name="topik" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="">Pilih Topik</option>
                    <option value="belajar">Belajar (Akademik)</option>
                    <option value="sosial">Sosial (Pertemanan)</option>
                    <option value="pribadi">Pribadi (Diri Sendiri)</option>
                    <option value="keluarga">Keluarga</option>
                </select>
                @error('topik') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Ringkasan Masalah</label>
                <textarea name="ringkasan_masalah" rows="5" class="mt-1 block w-full border border-gray-300 rounded-md p-2" 
                    placeholder="Jelaskan masalah yang ingin Anda diskusikan..." required></textarea>
                <p class="text-xs text-gray-500 mt-1">Minimal 10 karakter, maksimal 500 karakter</p>
                @error('ringkasan_masalah') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Kirim Pengajuan</button>
                <a href="{{ route('siswa.konseling.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
