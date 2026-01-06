@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Detail Siswa</h1>
        <div class="space-x-2">
            @can('update', $siswa)
                <a href="{{ route('admin.siswas.edit', $siswa) }}" class="px-3 py-2 bg-indigo-600 text-white rounded-md">Edit</a>
            @endcan

            @can('delete', $siswa)
                <form action="{{ route('admin.siswas.destroy', $siswa) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded-md">Hapus</button>
                </form>
            @endcan

            <a href="{{ route('admin.siswas.index') }}" class="px-3 py-2 border rounded-md">Kembali</a>
        </div>
    </div>

    {{-- Success / Error messages --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-800 rounded-md">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow">
        <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-500">NIS</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->nis }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->nama_lengkap }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->kelas }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Jurusan</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->jurusan ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->email ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">No HP</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->no_hp ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ $siswa->tgl_lahir ? \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d M Y') : '—' }}
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->jenis_kelamin ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Wali Kelas</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->waliKelas ? $siswa->waliKelas->name . ' <' . $siswa->waliKelas->email . '>' : '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->status ?? '—' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Terhubung ke Akun</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $siswa->user ? $siswa->user->email : '—' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection