@extends('layouts.app')

@section('title', 'Manajemen Konseling')

@section('content')
<div class="w-full">
    <h1 class="text-2xl font-bold mb-4">Pengajuan Konseling</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($konselings as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium">{{ $item->siswa->nama_lengkap ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $item->tanggal?->format('d M Y') ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ ucfirst($item->topik ?? 'N/A') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $item->status === 'disetujui' ? 'bg-green-100 text-green-800' : ($item->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('admin.konseling.show', $item) }}" class="text-indigo-600 hover:text-indigo-800">Lihat</a>
                            <a href="{{ route('admin.konseling.edit', $item) }}" class="text-yellow-600 hover:text-yellow-800">Proses</a>
                            <form action="{{ route('admin.konseling.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin?')" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada pengajuan konseling</td>
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
