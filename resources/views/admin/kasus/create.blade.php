@extends('layouts.app')

@section('title', 'Tambah Kasus')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah Catatan Kasus</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('admin.kasus.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Siswa</label>
                <select name="siswa_id" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="">Pilih Siswa</option>
                    @foreach($siswas as $siswa)
                        <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                            {{ $siswa->nama_lengkap }} ({{ $siswa->kelas }})
                        </option>
                    @endforeach
                </select>
                @error('siswa_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Jenis Kasus</label>
                <input type="text" name="jenis" value="{{ old('jenis') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Contoh: Bolos, Perundungan" required>
                @error('jenis') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tingkat Keparahan</label>
                    <select name="severity" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                        <option value="ringan" {{ old('severity') == 'ringan' ? 'selected' : '' }}>Ringan</option>
                        <option value="sedang" {{ old('severity') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="berat" {{ old('severity') == 'berat' ? 'selected' : '' }}>Berat</option>
                    </select>
                    @error('severity') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Poin Pelanggaran</label>
                    <input type="number" name="poin" value="{{ old('poin', 0) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" min="0" max="100" required>
                    @error('poin') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                        <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Kasus</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    @error('tanggal') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                <a href="{{ route('admin.kasus.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
