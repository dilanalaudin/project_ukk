@extends('layouts.app')

@section('title', 'Pengajuan Konseling')

@section('content')
<div class="w-full">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Pengajuan Konseling</h1>
        <a href="{{ route('siswa.konseling.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">+ Ajukan Konseling</a>
    </div>



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
                            <x-model-status-badge :status="$item->status" />
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
