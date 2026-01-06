<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KasusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kasus = Kasus::with('siswa')->latest()->paginate(10);
        return view('admin.kasus.index', compact('kasus'));
    }

    public function create()
    {
        $siswas = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.kasus.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis' => 'required|string',
            'severity' => 'required|in:ringan,berat',
            'poin' => 'required|integer|min:0|max:100',
            'status' => 'required|in:proses,selesai',
            'tanggal' => 'nullable|date',
        ]);

        Kasus::create($validated);
        return redirect()->route('admin.kasus.index')->with('success', 'Pelanggaran siswa berhasil ditambahkan');
    }

    public function show(Kasus $kasu)
    {
        return view('admin.kasus.show', ['kasus' => $kasu]);
    }

    public function edit(Kasus $kasu)
    {
        $siswas = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.kasus.edit', ['kasus' => $kasu, 'siswas' => $siswas]);
    }

    public function update(Request $request, Kasus $kasu)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis' => 'required|string',
            'severity' => 'required|in:ringan,berat',
            'poin' => 'required|integer|min:0|max:100',
            'status' => 'required|in:proses,selesai',
            'tanggal' => 'nullable|date',
        ]);

        $kasu->update($validated);
        return redirect()->route('admin.kasus.index')->with('success', 'Pelanggaran siswa berhasil diperbarui');
    }

    public function destroy(Kasus $kasu)
    {
        $kasu->delete();
        return redirect()->route('admin.kasus.index')->with('success', 'Pelanggaran siswa berhasil dihapus');
    }
}
