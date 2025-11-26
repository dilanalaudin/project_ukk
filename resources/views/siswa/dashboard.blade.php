@extends('layouts.app')

@section('title', 'Dashboard - Siswa')

@section('content')
  <div class="bg-white rounded-lg p-6 shadow">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->name ?? Auth::user()->email }}</h1>
      <div class="text-sm text-gray-500">Siswa</div>
    </div>

    <div class="mt-4 grid md:grid-cols-3 gap-4">
      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Jadwal Konsultasi</div>
        <div class="text-lg font-semibold mt-2">Belum Ada</div>
        <a href="#" class="text-indigo-600 text-sm mt-2 inline-block">Lihat jadwal</a>
      </div>
      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Catatan Konseling</div>
        <div class="text-lg font-semibold mt-2">2</div>
        <a href="#" class="text-indigo-600 text-sm mt-2 inline-block">Lihat catatan</a>
      </div>
      <div class="p-4 border rounded">
        <div class="text-sm text-gray-500">Kontak Guru BK</div>
        <div class="text-lg font-semibold mt-2">Guru BK Sekolah</div>
        <a href="#" class="text-indigo-600 text-sm mt-2 inline-block">Hubungi</a>
      </div>
    </div>
  </div>
@endsection