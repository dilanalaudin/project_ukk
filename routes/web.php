<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Penting: Tambahkan Fasad Auth
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use App\Models\User; // Model User

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute Default: Menampilkan halaman welcome untuk guest; jika sudah login arahkan ke dashboard
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome'); // tampilkan welcome sebelum login
})->name('home');

// Route khusus welcome (opsional)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// === Rute Autentikasi ===

// 1. Form Login
Route::get('/login', function () {
    // Jika user sudah login, arahkan langsung ke dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

// 2. Proses Login
Route::post('/login', function (Request $request) {
    // Validasi input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Mencoba login menggunakan mekanisme Auth::attempt() Laravel
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        // Regenerate session ID untuk keamanan
        $request->session()->regenerate();

        // Redirect ke rute dashboard atau intended
        return redirect()->intended('/dashboard'); 
    }

    // Login Gagal: Kembali ke halaman sebelumnya dengan pesan error
    return back()->withErrors([
        'email' => 'Email atau Password yang Anda masukkan salah.',
    ])->onlyInput('email');
})->name('login.post');


// 3. Register (GET)
Route::get('/register', function () {
    // Jika user sudah login, arahkan langsung ke dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.register');
})->name('register');

// 4. Register (POST)
Route::post('/register', function (Request $request) {
    // Validasi input registrasi
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'confirmed', 'min:6'],
    ]);

    // Buat user
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    // Login otomatis setelah registrasi
    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->intended('/dashboard');
})->name('register.post');


// 5. Rute Dashboard (Hanya bisa diakses jika sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Anda bisa mengambil data pengguna yang sedang login
        // $user = Auth::user(); 
        return view('dashboard');
    })->name('dashboard');
    
    // 6. Logout
    Route::post('/logout', function (Request $request) {
        // Method Auth::logout() menghapus sesi autentikasi
        Auth::logout();
        
        // Hapus sesi lama dan buat sesi baru
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect kembali ke halaman login
        return redirect('/login');
    })->name('logout');
});


// === Rute Admin/Resource ===
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Pastikan SiswaController di-import jika Anda menggunakannya
    // use App\Http\Controllers\SiswaController; // Tambahkan ini jika belum ada

    Route::resource('siswas', \App\Http\Controllers\SiswaController::class);
});