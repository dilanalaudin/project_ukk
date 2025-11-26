<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    public function __construct()
    {
        // Tetap gunakan middleware auth; authorize/policy mengatur role
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewAny', Siswa::class);
        $siswas = Siswa::orderBy('nama_lengkap', 'asc')->paginate(12);
        return view('admin.datasiswa', compact('siswas'));
    }

    public function create()
    {
        $this->authorize('create', Siswa::class);
        return view('admin.siswas.create');
    }

    public function store(StoreSiswaRequest $request)
    {
        $this->authorize('create', Siswa::class);
        Siswa::create($request->validated());
        return redirect()->route('admin.siswas.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        $this->authorize('view', $siswa);
        return view('admin.siswas.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $this->authorize('update', $siswa);
        return view('admin.siswas.edit', compact('siswa'));
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $this->authorize('update', $siswa);
        $siswa->update($request->validated());
        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $this->authorize('delete', $siswa);
        $siswa->delete();
        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}