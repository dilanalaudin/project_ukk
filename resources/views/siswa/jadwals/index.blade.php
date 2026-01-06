@extends('layouts.app')

@section('title', 'Jadwal Konsultasi - Siswa')

@section('content')
  <div class="bg-white rounded-lg p-6 shadow">
    <h1 class="text-2xl font-semibold mb-4">Jadwal Konsultasi</h1>
    @if ($jadwals->isEmpty())
      <div class="p-4">Belum ada jadwal.</div>
    @else
      <table class="min-w-full divide-y divide-gray-200">
        <thead>
          <tr>
            <th class="px-6 py-3">Tanggal</th>
            <th class="px-6 py-3">Jenis</th>
            <th class="px-6 py-3">Keterangan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($jadwals as $jadwal)
            <tr>
              <td class="px-6 py-3">{{ \Illuminate\Support\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
              <td class="px-6 py-3">{{ $jadwal->jenis }}</td>
              <td class="px-6 py-3">{{ $jadwal->keterangan }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
@endsection
