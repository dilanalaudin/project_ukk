<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonselingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lihat daftar pengajuan konseling siswa (TYPE_JADWAL)
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $siswa = null;
        if (Siswa::where('user_id', $user->id)->exists()) {
            $siswa = Siswa::where('user_id', $user->id)->first();
        } elseif (Siswa::where('email', $user->email)->exists()) {
            $siswa = Siswa::where('email', $user->email)->first();
        }

        if (!$siswa) {
            abort(404, 'Siswa tidak ditemukan.');
        }

        // Pengajuan konseling (jadwal) siswa
        $konselings = Konseling::where('siswa_id', $siswa->id)
            ->where('type', Konseling::TYPE_JADWAL)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('siswa.konseling.index', compact('konselings'));
    }

    /**
     * Form pengajuan konseling
     */
    public function create()
    {
        return view('siswa.konseling.create');
    }

    /**
     * Simpan pengajuan konseling
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first() ?? Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return redirect()->route('dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $validated = $request->validate([
            'tanggal' => 'required|date|after:today',
            'topik' => 'required|in:belajar,sosial,pribadi,keluarga',
            'ringkasan_masalah' => 'required|string|min:10|max:500',
        ]);

        Konseling::create([
            'siswa_id' => $siswa->id,
            'type' => Konseling::TYPE_JADWAL,
            'tanggal' => $validated['tanggal'],
            'topik' => $validated['topik'],
            'ringkasan_masalah' => $validated['ringkasan_masalah'],
            'status' => 'proses',
        ]);

        return redirect()->route('admin.konseling.index')->with('success', 'Pengajuan konseling berhasil dikirim. Lihat pengajuan Anda di daftar konseling.');
    }

    /**
     * Lihat detail pengajuan/hasil konseling
     */
    public function show(Konseling $konseling)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first() ?? Siswa::where('email', $user->email)->first();

        if (!$siswa || $konseling->siswa_id !== $siswa->id) {
            abort(403);
        }

        return view('siswa.konseling.show', compact('konseling'));
    }

    /**
     * Riwayat konseling (yang sudah selesai/disetujui)
     */
    public function history()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first() ?? Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return redirect()->route('dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $riwayat = Konseling::where('siswa_id', $siswa->id)
            ->whereIn('type', [Konseling::TYPE_NOTE, Konseling::TYPE_KONSELING])
            ->where('status', 'disetujui')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('siswa.konseling.history', compact('riwayat'));
    }

    /**
     * Lihat semua catatan konseling (untuk notes page)
     */
    public function notes()
    {
        $user = Auth::user();
        $siswa = null;
        if (Siswa::where('user_id', $user->id)->exists()) {
            $siswa = Siswa::where('user_id', $user->id)->first();
        } elseif (Siswa::where('email', $user->email)->exists()) {
            $siswa = Siswa::where('email', $user->email)->first();
        }

        if (!$siswa) {
            abort(404, 'Siswa tidak ditemukan.');
        }

        // Return only 'note' typed records (past counseling)
        $konselings = Konseling::note()->where('siswa_id', $siswa->id)->orderBy('tanggal', 'desc')->paginate(10);
        return view('siswa.notes.index', compact('konselings'));
    }
}
