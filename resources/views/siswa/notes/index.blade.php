@extends('layouts.app')

@section('title', 'Catatan Konseling - Siswa')

@section('content')
  <div class="bg-white rounded-lg p-6 shadow">
    <h1 class="text-2xl font-semibold mb-4">Catatan Konseling</h1>
    @if ($konselings->isEmpty())
      <div class="p-4">Belum ada catatan konseling.</div>
    @else
      <div class="space-y-4">
        @foreach ($konselings as $note)
          <div class="border rounded p-3">
            <div class="text-sm text-gray-500">{{ \Illuminate\Support\Carbon::parse($note->tanggal)->format('d M Y') }}</div>
            <div class="text-lg font-semibold">{{ $note->jenis }}</div>
            <div class="text-gray-700 mt-2">{{ $note->keterangan }}</div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
