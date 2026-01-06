@extends('layouts.app')

@section('title', 'Visi Misi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Visi Misi BK</h1>
        <a href="{{ route('admin.visi-misi.edit') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Ubah</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Visi</h2>
            <p class="text-gray-700 leading-relaxed">{{ $visiMisi->visi ?? 'Belum diisi' }}</p>
        </div>

        <div class="border-t pt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Misi</h2>
            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $visiMisi->misi ?? 'Belum diisi' }}</p>
        </div>
    </div>
</div>
@endsection
