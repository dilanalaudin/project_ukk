@extends('layouts.app')

@section('title', 'Pengajuan Konseling')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Pengajuan Konseling</h1>
        <a href="{{ route('siswa.konseling.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">+ Ajukan Konseling</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($konselings as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm">{{ $item->tanggal?->format('d M Y') ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium">{{ ucfirst($item->topik ?? 'N/A') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $item->status === 'disetujui' ? 'bg-green-100 text-green-800' : ($item->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('siswa.konseling.show', $item) }}" class="text-indigo-600 hover:text-indigo-800">Lihat</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada pengajuan konseling</td>
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
