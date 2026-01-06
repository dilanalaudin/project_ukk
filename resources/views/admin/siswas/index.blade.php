@extends('layouts.app')

@section('title', 'Data Siswa - Admin')

@section('content')
<div class="flex-1">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Data Siswa</h1>

    <div class="flex items-center gap-2">
      <form action="{{ route('admin.siswas.index') }}" method="GET" class="flex items-center gap-2 bg-gray-50 rounded-md p-2">
          <span>🔍</span>
          <input name="q" value="{{ request('q') }}" class="border-0 outline-none bg-transparent" placeholder="Cari siswa..." />
          @if(request('q'))
            <a href="{{ route('admin.siswas.index') }}" class="text-sm text-gray-500">Reset</a>
          @endif
      </form>

      @can('create', App\Models\Siswa::class)
        <a href="{{ route('admin.siswas.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md">+ Tambah Siswa</a>
      @endcan
    </div>
  </div>

  <div class="card bg-white rounded-lg p-4 shadow">
    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="text-gray-500">
          <tr>
            <th class="text-left p-3">Nama</th>
            <th class="text-left p-3">NIS</th>
            <th class="text-left p-3">Kelas</th>
            <th class="text-left p-3">Jurusan</th>
            <th class="text-left p-3">Jenis Kelamin</th>
            <th class="text-left p-3">Status</th>
            <th class="text-left p-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          @forelse ($siswas ?? [] as $siswa)
            <tr>
              <td class="p-3">{{ $siswa->nama_lengkap }}</td>
              <td class="p-3">{{ $siswa->nis }}</td>
              <td class="p-3">{{ $siswa->kelas }}</td>
              <td class="p-3">{{ $siswa->jurusan ?? '-' }}</td>
              <td class="p-3">{{ ucfirst($siswa->jenis_kelamin ?? '-') }}</td>
              <td class="p-3">
                <span class="px-2 py-1 rounded-full text-xs {{ ($siswa->status ?? '') === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                  {{ $siswa->status ?? '—' }}
                </span>
              </td>
              <td class="p-3">
                <a href="{{ route('admin.siswas.show', $siswa) }}" class="px-3 py-1 bg-indigo-600 text-white rounded">Lihat</a>

                @can('update', $siswa)
                  <a href="{{ route('admin.siswas.edit', $siswa) }}" class="px-3 py-1 bg-yellow-500 text-white rounded ml-2">Edit</a>
                @endcan

                @can('delete', $siswa)
                  <form action="{{ route('admin.siswas.destroy', $siswa) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                  </form>
                @endcan
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="p-3 text-center text-gray-500">Belum ada data siswa.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      @if (isset($siswas) && method_exists($siswas, 'links'))
        {{ $siswas->links() }}
      @endif
    </div>
  </div>
</div>
@endsection