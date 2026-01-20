<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\CounselingStatusUpdated;

class KonselingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lihat daftar pengajuan konseling (admin/BK)
     */
    public function index()
    {
        $konselings = Konseling::with('siswa')
            ->where('type', Konseling::TYPE_JADWAL)
            ->orderBy('status')
            ->orderBy('tanggal')
            ->paginate(10);

        return view('admin.konseling.index', compact('konselings'));
    }

    /**
     * Lihat riwayat konseling (yang sudah selesai/catatan)
     */
    public function riwayat()
    {
        $konselings = Konseling::with('siswa')
            ->whereIn('type', [Konseling::TYPE_NOTE, Konseling::TYPE_KONSELING])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('admin.konseling.riwayat', compact('konselings'));
    }

    /**
     * Lihat detail pengajuan konseling
     */
    public function show(Konseling $konseling)
    {
        return view('admin.konseling.show', compact('konseling'));
    }

    /**
     * Form edit dan pencatatan hasil konseling
     */
    public function edit(Konseling $konseling)
    {
        $siswa = $konseling->siswa;
        return view('admin.konseling.edit', compact('konseling', 'siswa'));
    }

    /**
     * Update status dan catat hasil konseling
     */
    public function update(Request $request, Konseling $konseling)
    {
        $validated = $request->validate([
            'status' => 'required|in:proses,disetujui,ditolak,selesai',
            'tanggapan' => 'nullable|string|max:1000',
            'ringkasan_masalah' => 'nullable|string|max:500',
            'solusi' => 'nullable|string|max:500',
            'jadwal_berikutnya' => 'nullable|date|after:today',
        ]);

        $konseling->update($validated);

        // Jika status dikembalikan ke proses, kembalikan tipe ke jadwal (agar masuk ke list pengajuan)
        if ($validated['status'] === 'proses') {
            $konseling->update(['type' => Konseling::TYPE_JADWAL]);
        }
        // Jika disetujui dan sudah ada solusi, ubah type menjadi konseling (catatan hasil/history)
        elseif ($validated['status'] === 'disetujui' && $validated['solusi']) {
            $konseling->update(['type' => Konseling::TYPE_KONSELING]);
        } elseif ($validated['status'] === 'selesai') {
             // Opsional: jika selesai, bisa juga dianggap history (tergantung kebutuhan, tapi biasanya selesai = history)
             $konseling->update(['type' => Konseling::TYPE_KONSELING]);
        }



        // Kirim notifikasi ke Siswa
        if ($konseling->siswa && $konseling->siswa->user) {
            $konseling->siswa->user->notify(new CounselingStatusUpdated($validated['status'], $validated['tanggapan'] ?? null));
        }

        return redirect()->route('admin.konseling.index')->with('success', 'Hasil konseling berhasil disimpan');
    }

    /**
     * Hapus pengajuan konseling
     */
    public function destroy(Konseling $konseling)
    {
        $konseling->delete();
        return redirect()->route('admin.konseling.index')->with('success', 'Pengajuan konseling berhasil dihapus');
    }
}
