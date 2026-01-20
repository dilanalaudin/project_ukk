@extends('layouts.app')

@section('title', (auth()->user()->role === 'admin') ? 'Data Siswa - Admin' : 'Data Diri - Siswa')

@section('content')
@section('content')
<div class="w-full">
  <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">{{ (auth()->user()->role === 'admin') ? 'Data Siswa' : 'Data Diri' }}</h1>
        <p class="text-slate-500 text-sm mt-1">{{ (auth()->user()->role === 'admin') ? 'Kelola data siswa, termasuk tambah, edit, dan hapus.' : 'Informasi profil dan data akademik anda.' }}</p>
    </div>

    <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
      @if(auth()->user()->role === 'admin')
      <form action="{{ route('admin.siswas.index') }}" method="GET" class="relative group w-full md:w-64">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          </div>
          <input name="q" value="{{ request('q') }}" class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all shadow-sm" placeholder="Cari nama atau NIS..." />
          @if(request('q'))
            <a href="{{ route('admin.siswas.index') }}" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </a>
          @endif
      </form>
      @endif

      @can('create', App\Models\Siswa::class)
        <div class="flex gap-2 w-full md:w-auto">
             <a href="{{ route('admin.siswas.linkUsers') }}" class="px-4 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 hover:text-indigo-600 transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0 2.828 2.828 0 010 4 2.828 2.828 0 014 0m-4-7.656a4 4 0 005.656 0 2.828 2.828 0 010 4 2.828 2.828 0 01-4 0M10 5a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                Sync User
             </a>
             <a href="{{ route('admin.siswas.create') }}" class="px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Siswa
             </a>
        </div>
      @endcan
    </div>
  </div>

  <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    @if (session('success'))
      <div class="p-4 bg-emerald-50 border-b border-emerald-100 flex items-center text-emerald-700">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span class="text-sm font-medium">{{ session('success') }}</span>
      </div>
    @endif
    
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50 border-b border-slate-200">
            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Lengkap</th>
            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">NIS</th>
            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kelas</th>
            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jurusan</th>
            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jenis Kelamin</th>
            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse ($siswas ?? [] as $siswa)
            <tr class="hover:bg-slate-50 transition-colors group">
              <td class="px-6 py-4">
                  <div class="flex items-center">
                       <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs mr-3">
                          {{ substr($siswa->nama_lengkap ?? '?', 0, 1) }}
                       </div>
                       <span class="text-sm font-medium text-slate-900">{{ $siswa->nama_lengkap }}</span>
                  </div>
              </td>
              <td class="px-6 py-4 text-sm text-slate-600 font-mono">{{ $siswa->nis }}</td>
              <td class="px-6 py-4 text-sm text-slate-600">{{ $siswa->kelas }}</td>
              <td class="px-6 py-4 text-sm text-slate-600">{{ $siswa->jurusan ?? '-' }}</td>
              <td class="px-6 py-4 text-sm text-slate-600">{{ ucfirst($siswa->jenis_kelamin === 'L' ? 'Laki-laki' : ($siswa->jenis_kelamin === 'P' ? 'Perempuan' : ($siswa->jenis_kelamin ?? '-'))) }}</td>
              <td class="px-6 py-4">
                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ ($siswa->status ?? '') === 'Aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                  {{ $siswa->status ?? '—' }}
                </span>
              </td>
              <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                <a href="{{ route('admin.siswas.show', $siswa) }}" class="text-slate-400 hover:text-indigo-600 transition-colors" title="Lihat Detail">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </a>

                @can('update', $siswa)
                  <a href="{{ route('admin.siswas.edit', $siswa) }}" class="text-slate-400 hover:text-amber-500 transition-colors" title="Edit">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                  </a>
                @endcan

                @can('delete', $siswa)
                  <form action="{{ route('admin.siswas.destroy', $siswa) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors pt-1" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                  </form>
                @endcan
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                  <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2h-.09a4.52 4.52 0 00-3.92-3.834M12 9a3 3 0 100-6 3 3 0 000 6z"></path></svg>
                        <p class="font-medium">Belum ada data siswa ditemukan.</p>
                        <p class="text-xs mt-1">Silakan tambah siswa baru atau gunakan kata kunci pencarian lain.</p>
                  </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if (isset($siswas) && method_exists($siswas, 'links'))
      <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
        {{ $siswas->links() }}
      </div>
    @endif
  </div>
</div>
@endsection