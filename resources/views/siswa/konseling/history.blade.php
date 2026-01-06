@extends('layouts.app')

@section('title', 'Riwayat Konseling')

@section('content')
<div class="w-full">
    <h1 class="text-2xl font-bold mb-4">Riwayat Konseling</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Topik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ringkasan Masalah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Solusi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($riwayat as $item)
                        <tr>
                            <td class="px-6 py-4 text-sm">{{ $item->tanggal?->format('d M Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-medium">{{ ucfirst($item->topik ?? 'N/A') }}</td>
                            <td class="px-6 py-4 text-sm">{{ Str::limit($item->ringkasan_masalah, 50) }}</td>
                            <td class="px-6 py-4 text-sm">{{ Str::limit($item->solusi, 50) }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('siswa.konseling.show', $item) }}" class="text-indigo-600 hover:text-indigo-800">Lihat Detail</a>
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
    </div>

    <div class="mt-4">
        {{ $riwayat->links() }}
    </div>
</div>
@endsection
