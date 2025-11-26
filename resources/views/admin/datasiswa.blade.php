@extends('layouts.app')

@section('title', 'Data Siswa - Admin')

@section('content')
  <div class="flex-1">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Data Siswa</h1>
      <div class="flex items-center gap-2">
        <div class="flex items-center gap-2 bg-gray-50 rounded-md p-2">
          <span>🔍</span>
          <input class="border-0 outline-none bg-transparent" placeholder="Cari siswa..." />
        </div>
        @can('create', App\Models\Siswa::class)
          <a href="{{ route('admin.siswas.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md">+ Tambah Siswa</a>
        @endcan
      </div>
    </div>

    <div class="card bg-white rounded-lg p-4 shadow">
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="text-gray-500">
            <tr>
              <th class="text-left p-3">Nama</th>
              <th class="text-left p-3">NIS</th>
              <th class="text-left p-3">Kelas</th>
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
                <td class="p-3">
                  <span class="px-2 py-1 rounded-full text-xs {{ ($siswa->status ?? '') === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $siswa->status ?? '—' }}
                  </span>
                </td>
                <td class="p-3">
                  <a href="{{ route('admin.siswas.show', $siswa) }}" class="px-3 py-1 bg-indigo-600 text-white rounded">Lihat</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">Belum ada data siswa.</td>
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