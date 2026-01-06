<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Konseling;
use App\Models\Siswa;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $siswa = null;
        if (Siswa::where('user_id', $user->id)->exists()) {
            $siswa = Siswa::where('user_id', $user->id)->first();
        } elseif (Siswa::where('email', $user->email)->exists()) {
            $siswa = Siswa::where('email', $user->email)->first();
        }

        if (! $siswa) {
            abort(404, 'Siswa tidak ditemukan.');
        }

        // Use Konseling model for jadwals records (type = 'jadwal')
        $jadwals = Konseling::jadwal()->where('siswa_id', $siswa->id)->orderBy('tanggal', 'asc')->get();
        return view('siswa.jadwals.index', compact('jadwals'));
    }
}
