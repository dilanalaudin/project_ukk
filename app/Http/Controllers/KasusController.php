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
        $user = auth()->user();

        // ADMIN: lihat semua kasus
        if (($user->role ?? '') === 'admin') {
            $kasus = Kasus::with('siswa')
                ->latest()
                ->paginate(10);
        }
        // SISWA: lihat kasus miliknya saja
        else {
            $siswa = Siswa::where('user_id', $user->id)->first();

            if (!$siswa) {
                $kasus = Kasus::where('id', null)->paginate(10); // Return empty paginator
            } else {
                $kasus = Kasus::with('siswa')
                    ->where('siswa_id', $siswa->id)
                    ->latest()
                    ->paginate(10);
            }
        }

        return view('admin.kasus.index', compact('kasus'));
    }

    public function show(Kasus $kasus)
    {
        $user = auth()->user();

        // Jika siswa, hanya boleh melihat kasus miliknya
        if (($user->role ?? '') !== 'admin') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa || $kasus->siswa_id !== $siswa->id) {
                abort(403);
            }
        }

        return view('admin.kasus.show', compact('kasus'));
    }

    // ================= ADMIN ONLY =================

    public function create()
    {
        abort_unless((auth()->user()->role ?? '') === 'admin', 403);

        $siswas = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.kasus.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        abort_unless((auth()->user()->role ?? '') === 'admin', 403);

        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis' => 'required|string',
            'severity' => 'required|in:ringan,sedang,berat',
            'poin' => 'required|integer|min:0|max:100',
            'status' => 'required|in:proses,selesai',
            'tanggal' => 'nullable|date',
        ]);

        Kasus::create($validated);

        return redirect()->route('admin.kasus.index')
            ->with('success', 'Pelanggaran siswa berhasil ditambahkan');
    }

    public function edit(Kasus $kasus)
    {
        abort_unless((auth()->user()->role ?? '') === 'admin', 403);

        $siswas = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.kasus.edit', compact('kasus', 'siswas'));
    }

    public function update(Request $request, Kasus $kasus)
    {
        abort_unless((auth()->user()->role ?? '') === 'admin', 403);

        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis' => 'required|string',
            'severity' => 'required|in:ringan,sedang,berat',
            'poin' => 'required|integer|min:0|max:100',
            'status' => 'required|in:proses,selesai',
            'tanggal' => 'nullable|date',
        ]);

        $kasus->update($validated);

        return redirect()->route('admin.kasus.index')
            ->with('success', 'Pelanggaran siswa berhasil diperbarui');
    }

    public function destroy(Kasus $kasus)
    {
        abort_unless((auth()->user()->role ?? '') === 'admin', 403);

        $kasus->delete();

        return redirect()->route('admin.kasus.index')
            ->with('success', 'Pelanggaran siswa berhasil dihapus');
    }
}
