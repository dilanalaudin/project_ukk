@extends('layouts.app')

@section('title', 'Proses Konseling')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Proses & Catat Hasil Konseling</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="mb-6 pb-6 border-b">
            <h3 class="text-lg font-semibold mb-3">Informasi Siswa</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-semibold">{{ $siswa->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kelas</p>
                    <p class="font-semibold">{{ $siswa->kelas }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jurusan</p>
                    <p class="font-semibold">{{ $siswa->jurusan }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jenis Kelamin</p>
                    <p class="font-semibold">{{ ($siswa->jenis_kelamin === 'L' || $siswa->jenis_kelamin === 'Laki-laki') ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
            </div>
        </div>

        <div class="mb-6 pb-6 border-b">
            <h3 class="text-lg font-semibold mb-3">Pengajuan</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Tanggal Konseling</p>
                    <p class="font-semibold">{{ $konseling->tanggal?->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Topik</p>
                    <p class="font-semibold">{{ ucfirst($konseling->topik) }}</p>
                </div>
            </div>
            <div class="mt-3">
                <p class="text-sm text-gray-500">Ringkasan Masalah</p>
                <p class="text-gray-700">{{ $konseling->ringkasan_masalah }}</p>
            </div>
        </div>

        <form action="{{ route('admin.konseling.update', $konseling) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status Pengajuan</label>
                <select name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="proses" {{ $konseling->status === 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="disetujui" {{ $konseling->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ $konseling->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ $konseling->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Ringkasan Masalah (Pencatatan BK)</label>
                <textarea name="ringkasan_masalah" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                    placeholder="Ringkasan hasil wawancara/observasi...">{{ $konseling->ringkasan_masalah ?? '' }}</textarea>
                @error('ringkasan_masalah') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Solusi / Tindak Lanjut</label>
                <textarea name="solusi" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                    placeholder="Solusi, rekomendasi, atau tindak lanjut yang disepakati...">{{ $konseling->solusi ?? '' }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Maksimal 500 karakter</p>
                @error('solusi') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jadwal Temu Berikutnya</label>
                <input type="date" name="jadwal_berikutnya" value="{{ $konseling->jadwal_berikutnya?->format('Y-m-d') }}" 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2" min="{{ date('Y-m-d') }}">
                @error('jadwal_berikutnya') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan Hasil</button>
                <a href="{{ route('admin.konseling.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
