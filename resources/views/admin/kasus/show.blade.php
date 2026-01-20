@extends('layouts.app')

@section('title', 'Detail Kasus')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Detail Catatan Kasus</h1>
        <p class="text-slate-500">Rincian informasi pelanggaran siswa.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
             <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">{{ $kasus->jenis }}</h3>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $kasus->severity === 'berat' ? 'bg-red-100 text-red-700' : ($kasus->severity === 'sedang' ? 'bg-orange-100 text-orange-700' : 'bg-emerald-100 text-emerald-700') }}">
                    {{ $kasus->severity }}
                </span>
             </div>
        </div>
        
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Nama Siswa</h4>
                    <p class="text-slate-900 font-medium">{{ $kasus->siswa->nama_lengkap ?? '-' }}</p>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kelas</h4>
                    <p class="text-slate-900 font-medium">{{ $kasus->siswa->kelas ?? '-' }}</p>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Poin Pelanggaran</h4>
                    <p class="text-red-600 font-bold text-lg">{{ $kasus->poin }} Poin</p>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Tanggal Kejadian</h4>
                    <p class="text-slate-900 font-medium">{{ $kasus->tanggal ? $kasus->tanggal->format('d F Y') : '-' }}</p>
                </div>
                 <div>
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Status Penanganan</h4>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $kasus->status === 'selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst($kasus->status) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="bg-slate-50 px-6 py-4 flex justify-end">
             <button onclick="history.back()" class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors">
                Kembali
            </button>
        </div>
    </div>
</div>
@endsection
