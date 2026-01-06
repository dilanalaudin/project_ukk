<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\KasusController;
use App\Http\Controllers\KonselingController;

/*
|--------------------------------------------------------------------------
| Root Route (otomatis arahkan sesuai role)
|--------------------------------------------------------------------------
*/
// Root route: map `/` to `/welcome` for convenience, but preserve `/welcome` as main page
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/welcome', function () {
    // Tampilkan halaman welcome untuk pengunjung yang belum login
    if (!auth()->check()) {
        return view('welcome');
    }

    // Jika admin → ke dashboard admin
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Jika user biasa → dashboard umum
    return redirect()->route('dashboard');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login')->middleware('guest');
    Route::post('/login', 'login')->name('login.post')->middleware('guest');

    Route::get('/register', 'showRegister')->name('register')->middleware('guest');
    Route::post('/register', 'register')->name('register.post')->middleware('guest');

    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

/*
|--------------------------------------------------------------------------
| Dashboard for authenticated users (non-admin/siswa)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:siswa'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Siswa Routes (student area) – under prefix /siswa
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')
    ->name('siswa.')
    ->middleware(['auth', 'role:siswa'])
    ->group(function () {
        Route::get('jadwals', [App\Http\Controllers\Siswa\JadwalController::class, 'index'])->name('jadwals.index');
        Route::get('notes', [App\Http\Controllers\Siswa\KonselingController::class, 'notes'])->name('notes.index');
        
        // Pengajuan Konseling
        Route::get('konseling', [App\Http\Controllers\Siswa\KonselingController::class, 'index'])->name('konseling.index');
        Route::get('konseling/create', [App\Http\Controllers\Siswa\KonselingController::class, 'create'])->name('konseling.create');
        Route::post('konseling', [App\Http\Controllers\Siswa\KonselingController::class, 'store'])->name('konseling.store');
        Route::get('konseling/{konseling}', [App\Http\Controllers\Siswa\KonselingController::class, 'show'])->name('konseling.show');
        
        // Riwayat Konseling
        Route::get('konseling-history', [App\Http\Controllers\Siswa\KonselingController::class, 'history'])->name('konseling.history');
    });

/*
|--------------------------------------------------------------------------
| Admin Routes (prefix admin) — protected by auth + isAdmin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        // Admin Dashboard (path: /admin/dashboard, name: admin.dashboard)
        // Must use admin.dashboard view, not the root dashboard view
        Route::get('dashboard', function () {
            return app(DashboardController::class)->index(request());
        })->name('dashboard');

        // CRUD Siswa (path: /admin/siswas/*, names: admin.siswas.*)
        Route::resource('siswas', SiswaController::class);

        // Visi Misi Management (path: /admin/visi-misi/*)
        Route::get('visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi.index');
        Route::get('visi-misi/edit', [VisiMisiController::class, 'edit'])->name('visi-misi.edit');
        Route::put('visi-misi', [VisiMisiController::class, 'update'])->name('visi-misi.update');

        // Catatan Kasus Management (path: /admin/kasus/*)
        Route::resource('kasus', KasusController::class);

        // Konseling Management (path: /admin/konseling/*)
        Route::resource('konseling', KonselingController::class, ['except' => ['create', 'store']]);
    });