@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah Siswa</h1>

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('admin.siswas.store') }}" method="POST">
            @csrf
            @include('admin.siswas._form', ['submitButtonText' => 'Tambah'])
        </form>
    </div>
</div>
@endsection