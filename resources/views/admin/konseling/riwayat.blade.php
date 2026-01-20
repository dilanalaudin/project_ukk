@extends('layouts.app')

@section('title', 'Riwayat Konseling')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Riwayat & Catatan Konseling</h1>
        <a href="{{ route('admin.konseling.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Kembali ke Pengajuan</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topik / Masalah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($konselings as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm">{{ $item->tanggal ? $item->tanggal->format('d M Y') : '-' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="font-medium">{{ $item->siswa->nama_lengkap ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $item->siswa->kelas ?? '' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="font-medium">{{ $item->topik ? ucfirst($item->topik) : 'Lainnya' }}</div>
                            <div class="text-xs text-gray-500 truncate w-48">{{ Str::limit($item->ringkasan_masalah, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $item->status === 'disetujui' ? 'bg-green-100 text-green-800' : ($item->status === 'selesai' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('admin.konseling.edit', $item) }}" class="text-indigo-600 hover:text-indigo-800">Ubah Status</a>
                            <a href="{{ route('admin.konseling.show', $item) }}" class="text-gray-600 hover:text-gray-800">Detail</a>
                            <form action="{{ route('admin.konseling.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 ml-1">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat konseling</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $konselings->links() }}
    </div>
</div>
@endsection
