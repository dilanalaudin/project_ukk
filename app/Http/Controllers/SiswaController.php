<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
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

    public function index(Request $request)
    {
        $this->authorize('viewAny', Siswa::class);
        $query = Siswa::query();

        if ($q = $request->query('q')) {
            $query->where(function ($builder) use ($q) {
                $builder->where('nama_lengkap', 'like', "%{$q}%")
                    ->orWhere('nis', 'like', "%{$q}%")
                    ->orWhere('kelas', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $siswas = $query->orderBy('nama_lengkap', 'asc')->paginate(12)->withQueryString();
        return view('admin.siswas.index', compact('siswas'));
    }

    public function create()
    {
        $this->authorize('create', Siswa::class);
        // opsi: tampilkan daftar guru/wali kelas sebagai pilihan
        $users = User::where('role', 'guru')->orderBy('name')->get();
        return view('admin.siswas.create', compact('users'));
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
        $users = User::where('role', 'guru')->orderBy('name')->get();
        return view('admin.siswas.edit', compact('siswa', 'users'));
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