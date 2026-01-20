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

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

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
        // daftar akun siswa (untuk mengaitkan Siswa dengan akun User)
        $siswaUsers = User::where('role', 'siswa')->orderBy('name')->get();
        return view('admin.siswas.create', compact('users', 'siswaUsers'));
    }

    public function store(StoreSiswaRequest $request)
    {
        $this->authorize('create', Siswa::class);
        $data = $request->validated();

        // Jika admin tidak mengirim user_id tetapi mengisi email yang sama dengan user,
        // kaitkan siswa ke user tersebut agar muncul di halaman user.
        if (empty($data['user_id']) && !empty($data['email'])) {
            $user = User::where('email', $data['email'])->first();
            if ($user) {
                $data['user_id'] = $user->id;
            }
        }

        Siswa::create($data);
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
        $siswaUsers = User::where('role', 'siswa')->orderBy('name')->get();
        return view('admin.siswas.edit', compact('siswa', 'users', 'siswaUsers'));
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $this->authorize('update', $siswa);
        $data = $request->validated();

        // Jika admin mengubah email dan tidak mengatur user_id, coba kaitkan ke user yang cocok
        if (empty($data['user_id']) && !empty($data['email'])) {
            $user = User::where('email', $data['email'])->first();
            if ($user) {
                $data['user_id'] = $user->id;
            }
        }

        $siswa->update($data);
        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $this->authorize('delete', $siswa);
        $siswa->delete();
        return redirect()->route('admin.siswas.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Bulk link existing Siswa records to User accounts by email (admin only).
     */
    public function linkUsers()
    {
        $this->authorize('create', Siswa::class); // only admin allowed by request rule

        $count = 0;
        Siswa::whereNull('user_id')->whereNotNull('email')->where('email', '<>', '')->chunkById(100, function ($siswas) use (&$count) {
            foreach ($siswas as $siswa) {
                $email = trim(strtolower($siswa->email));
                if (!$email) continue;
                $user = User::whereRaw('LOWER(TRIM(email)) = ?', [$email])->first();
                if ($user) {
                    $siswa->user_id = $user->id;
                    $siswa->save();
                    $count++;
                }
            }
        });

        return redirect()->route('admin.siswas.index')->with('success', "Linked {$count} siswa to user accounts based on email (case-insensitive).");
    }
}