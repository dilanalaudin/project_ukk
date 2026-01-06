<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use App\Models\Siswa;
use App\Models\Konseling;
use App\Models\Kasus;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $data = [
            'totalSiswa' => 0,
            'kasusBulanIni' => 0,
            'pelanggaranBerat' => 0,
            'konselingTerjadwal' => 0,
            'siswa' => null,
            'catatanCount' => 0,
            'kasusCount' => 0,
            'totalPoin' => 0,
            'kasusList' => [],
        ];

        if (Schema::hasTable((new Siswa)->getTable())) {
            $data['totalSiswa'] = Siswa::count();
        }

        if (Schema::hasTable('kasus')) {
            $now = Carbon::now();
            $data['kasusBulanIni'] = DB::table('kasus')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
            if (Schema::hasColumn('kasus', 'severity')) {
                $data['pelanggaranBerat'] = DB::table('kasus')->where('severity', 'berat')->count();
            } elseif (Schema::hasColumn('kasus', 'jenis')) {
                $data['pelanggaranBerat'] = DB::table('kasus')->where('jenis', 'like', '%Berat%')->count();
            }
        } elseif (Schema::hasTable('cases')) {
            $now = Carbon::now();
            $data['kasusBulanIni'] = DB::table('cases')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
            if (Schema::hasColumn('cases', 'severity')) {
                $data['pelanggaranBerat'] = DB::table('cases')->where('severity', 'heavy')->count();
            }
        }

        if (($user->role ?? '') === 'admin') {
            // Count scheduled counseling events using konselings with type 'jadwal'
            if (Schema::hasTable('konselings')) {
                $data['konselingTerjadwal'] = DB::table('konselings')->where('type', Konseling::TYPE_JADWAL)->whereDate('tanggal', '>=', Carbon::today())->count();
            } elseif (Schema::hasTable('schedules')) {
                $data['konselingTerjadwal'] = DB::table('schedules')->whereDate('date', '>=', Carbon::today())->count();
            }

            // Recent cases for today to show in admin activity
            if (Schema::hasTable('kasus')) {
                $data['todayKasus'] = Kasus::with('siswa')->whereDate('tanggal', Carbon::today())->latest()->take(5)->get();
            } else {
                $data['todayKasus'] = collect();
            }

            return view('admin.dashboard', $data);
        }

        $siswaModel = null;
        if (Schema::hasTable((new Siswa)->getTable())) {
            if (Schema::hasColumn((new Siswa)->getTable(), 'user_id')) {
                $siswaModel = Siswa::where('user_id', $user->id)->first();
            } elseif (Schema::hasColumn((new Siswa)->getTable(), 'email')) {
                $siswaModel = Siswa::where('email', $user->email)->first();
            }
            $data['siswa'] = $siswaModel;
        }

        if ($siswaModel) {
            if (Schema::hasTable('konselings')) {
                $data['catatanCount'] = DB::table('konselings')->where('siswa_id', $siswaModel->id)->where(function($q){$q->where('type', Konseling::TYPE_NOTE)->orWhere('type', Konseling::TYPE_KONSELING);})->count();
            } elseif (Schema::hasTable('notes')) {
                $data['catatanCount'] = DB::table('notes')->where('siswa_id', $siswaModel->id)->count();
            }

            if (Schema::hasTable('konselings')) {
                $data['konselingTerjadwal'] = DB::table('konselings')->where('type', Konseling::TYPE_JADWAL)->where('siswa_id', $siswaModel->id)->whereDate('tanggal', '>=', Carbon::today())->count();
            } elseif (Schema::hasTable('schedules')) {
                $data['konselingTerjadwal'] = DB::table('schedules')->where('siswa_id', $siswaModel->id)->whereDate('date', '>=', Carbon::today())->count();
            }

            // Hitung kasus dan poin pelanggaran
            if (Schema::hasTable('kasus')) {
                $data['kasusCount'] = Kasus::where('siswa_id', $siswaModel->id)->count();
                $data['totalPoin'] = Kasus::where('siswa_id', $siswaModel->id)->sum('poin');
                $data['kasusList'] = Kasus::where('siswa_id', $siswaModel->id)->latest()->take(5)->get();
            }
        }

        // Jika bukan admin (siswa / user lain), tampilkan dashboard siswa
        return view('siswa.dashboard', $data);
    }
}