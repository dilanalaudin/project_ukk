@extends('layouts.app')

@section('title', 'Ubah Visi Misi')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Ubah Visi Misi BK</h1>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.visi-misi.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="visi" class="block text-sm font-medium text-gray-700">Visi</label>
                <textarea 
                    id="visi" 
                    name="visi" 
                    rows="4" 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >{{ old('visi', $visiMisi->visi ?? '') }}</textarea>
                @error('visi') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="misi" class="block text-sm font-medium text-gray-700">Misi</label>
                <textarea 
                    id="misi" 
                    name="misi" 
                    rows="6" 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >{{ old('misi', $visiMisi->misi ?? '') }}</textarea>
                @error('misi') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                <a href="{{ route('admin.visi-misi.index') }}" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
