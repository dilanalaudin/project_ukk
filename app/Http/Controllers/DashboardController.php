<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
use App\Models\Siswa;

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
            if (Schema::hasTable('jadwals')) {
                $data['konselingTerjadwal'] = DB::table('jadwals')->whereDate('tanggal', '>=', Carbon::today())->count();
            } elseif (Schema::hasTable('schedules')) {
                $data['konselingTerjadwal'] = DB::table('schedules')->whereDate('date', '>=', Carbon::today())->count();
            }

            return view('dashboard', $data);
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
                $data['catatanCount'] = DB::table('konselings')->where('siswa_id', $siswaModel->id)->count();
            } elseif (Schema::hasTable('notes')) {
                $data['catatanCount'] = DB::table('notes')->where('siswa_id', $siswaModel->id)->count();
            }

            if (Schema::hasTable('jadwals')) {
                $data['konselingTerjadwal'] = DB::table('jadwals')->where('siswa_id', $siswaModel->id)->whereDate('tanggal', '>=', Carbon::today())->count();
            } elseif (Schema::hasTable('schedules')) {
                $data['konselingTerjadwal'] = DB::table('schedules')->where('siswa_id', $siswaModel->id)->whereDate('date', '>=', Carbon::today())->count();
            }
        }

        return view('dashboard', $data);
    }
}