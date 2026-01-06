@extends('layouts.app')

@section('title', 'Dashboard - Siswa')

@section('content')
  <div class="w-full">
    <div class="bg-white rounded-lg p-6 shadow mb-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Halo Siswa</h1>
        <div class="text-sm text-gray-500">Dashboard Siswa</div>
      </div>

      <div class="mt-4 grid md:grid-cols-4 gap-4">
        <div class="p-4 border rounded-lg border-l-4 border-l-blue-500">
          <div class="text-sm text-gray-500">Jadwal Konsultasi</div>
          <div class="text-lg font-semibold mt-2">{{ $konselingTerjadwal ?? 0 }}</div>
          <a href="{{ route('siswa.jadwals.index') }}" class="text-indigo-600 text-sm mt-2 inline-block">Lihat jadwal →</a>
        </div>

        <div class="p-4 border rounded-lg border-l-4 border-l-green-500">
          <div class="text-sm text-gray-500">Catatan Konseling</div>
          <div class="text-lg font-semibold mt-2">{{ $catatanCount ?? 0 }}</div>
          <a href="{{ route('siswa.notes.index') }}" class="text-indigo-600 text-sm mt-2 inline-block">Lihat catatan →</a>
        </div>

        <div class="p-4 border rounded-lg border-l-4 border-l-yellow-500">
          <div class="text-sm text-gray-500">Total Pelanggaran</div>
          <div class="text-lg font-semibold mt-2">{{ $kasusCount ?? 0 }}</div>
        </div>

        <div class="p-4 border rounded-lg border-l-4 border-l-red-500">
          <div class="text-sm text-gray-500">Total Poin Pelanggaran</div>
          <div class="text-lg font-semibold mt-2 text-red-600">{{ $totalPoin ?? 0 }}</div>
        </div>
      </div>
    </div>

    @if($kasusList && count($kasusList) > 0)
    <div class="bg-white rounded-lg p-6 shadow">
      <h2 class="text-xl font-semibold mb-4">Riwayat Pelanggaran</h2>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 border-b">
            <tr>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Jenis Pelanggaran</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tingkat</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Poin</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Status</th>
              <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            @foreach($kasusList as $kasus)
              <tr>
                <td class="px-4 py-2 text-sm">{{ $kasus->jenis }}</td>
                <td class="px-4 py-2 text-sm">
                  <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $kasus->severity === 'berat' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($kasus->severity) }}
                  </span>
                </td>
                <td class="px-4 py-2 text-sm font-semibold text-red-600">{{ $kasus->poin }}</td>
                <td class="px-4 py-2 text-sm">
                  <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $kasus->status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ ucfirst($kasus->status) }}
                  </span>
                </td>
                <td class="px-4 py-2 text-sm">{{ $kasus->tanggal ? $kasus->tanggal->format('d M Y') : '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </div>
@endsection