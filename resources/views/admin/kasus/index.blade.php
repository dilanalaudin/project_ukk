@extends('layouts.app')

@section('title', 'Catatan Kasus')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Catatan Kasus</h1>
        @if((auth()->user()->role ?? '') === 'admin')
            <a href="{{ route('admin.kasus.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">+ Tambah Kasus</a>
        @endif
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Kasus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tingkat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($kasus as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm">{{ $item->siswa->nama_lengkap ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->jenis }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $item->severity === 'berat' ? 'bg-red-100 text-red-800' : ($item->severity === 'sedang' ? 'bg-orange-100 text-orange-800' : 'bg-emerald-100 text-emerald-800') }}">
                                {{ ucfirst($item->severity) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold">{{ $item->poin }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $item->status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">{{ $item->tanggal ? $item->tanggal->format('d M Y') : '-' }}</td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            @if((auth()->user()->role ?? '') === 'admin')
                                <a href="{{ route('admin.kasus.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-800">Ubah</a>
                                <form action="{{ route('admin.kasus.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin?')" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            @else
                                <a href="{{ route('siswa.kasus.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-xs">Lihat Detail</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada catatan kasus</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kasus->links() }}
    </div>
</div>
@endsection
