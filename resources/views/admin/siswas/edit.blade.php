@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Siswa</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('admin.siswas.update', $siswa) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.siswas._form', ['submitButtonText' => 'Perbarui'])
        </form>

        @can('delete', $siswa)
            <form action="{{ route('admin.siswas.destroy', $siswa) }}" method="POST" class="mt-4" onsubmit="return confirm('Hapus siswa ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Hapus</button>
            </form>
        @endcan
    </div>
</div>
@endsection