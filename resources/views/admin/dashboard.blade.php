@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="w-full">

    <h1 class="text-3xl font-bold mb-6">Ringkasan Hari Ini</h1>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-indigo-500">
            <p class="text-sm text-gray-500">Total Siswa</p>
            <p class="text-3xl font-bold mt-1">{{ number_format($totalSiswa ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Kasus Bulan Ini</p>
            <p class="text-3xl font-bold mt-1">{{ number_format($kasusBulanIni ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-red-500">
            <p class="text-sm text-gray-500">Pelanggaran Berat</p>
            <p class="text-3xl font-bold mt-1">{{ number_format($pelanggaranBerat ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Konseling Terjadwal</p>
            <p class="text-3xl font-bold mt-1">{{ number_format($konselingTerjadwal ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Aktivitas Kasus Terbaru --}}
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Aktivitas Kasus Terbaru</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Jenis Kasus</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($todayKasus ?? [] as $k)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $k->siswa->nama_lengkap ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $k->siswa->kelas ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $k->jenis }} ({{ ucfirst($k->severity) }})</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $k->status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($k->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $k->tanggal?->format('d M Y') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada aktivitas kasus untuk hari ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Visi Misi Section -->
    <div class="bg-white p-6 rounded-xl shadow-lg mt-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Visi Misi BK</h3>
            <a href="{{ route('admin.visi-misi.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Lihat Lengkap →</a>
        </div>
        
        @php $visiMisi = \App\Models\VisiMisi::first(); @endphp
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Visi</h4>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $visiMisi->visi ?? 'Belum diisi' }}</p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-700 mb-2">Misi</h4>
                <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-wrap">{{ $visiMisi->misi ?? 'Belum diisi' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
