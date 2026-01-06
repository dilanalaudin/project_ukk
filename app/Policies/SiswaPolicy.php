<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiswaPolicy
{
    use HandlesAuthorization;

    /**
     * Tentukan apakah pengguna dapat melewati semua pemeriksaan otorisasi.
     * Metode ini dijalankan sebelum metode Policy lainnya.
     */
    public function before(User $user, string $ability): ?bool
    {
        // Jika pengguna memiliki role 'admin', dia diizinkan melakukan apapun
        if (($user->role ?? '') === 'admin') {
            return true;
        }

        // Biarkan pemeriksaan otorisasi berlanjut ke metode di bawah (viewAny, create, dll.)
        return null;
    }

    /**
     * Tentukan apakah pengguna dapat melihat daftar (view any) model Siswa.
     * Policy ini dipanggil oleh $this->authorize('viewAny', Siswa::class);
     */
    public function viewAny(User $user)
    {
        // Setelah before() ditambahkan, metode ini bisa dihapus, tapi kita biarkan 
        // agar kompatibel dengan Gate::define() Anda.
        // return ($user->role ?? '') === 'admin';
        return false; // Karena sudah ditangani di before(), ini tidak akan pernah tercapai untuk admin
    }

    /**
     * Tentukan apakah pengguna dapat melihat model Siswa tertentu.
     */
    public function view(User $user, Siswa $siswa)
    {
        // Admin sudah diizinkan oleh before(). 
        // Pemeriksaan ini hanya untuk Siswa yang melihat datanya sendiri.
        return $user->id === ($siswa->user_id ?? null);
    }

    /**
     * Tentukan apakah pengguna dapat membuat model Siswa baru.
     */
    public function create(User $user)
    {
        // Admin sudah diizinkan oleh before().
        return false; 
    }

    /**
     * Tentukan apakah pengguna dapat memperbarui model Siswa.
     */
    public function update(User $user, Siswa $siswa)
    {
        // Admin sudah diizinkan oleh before().
        return false;
    }

    /**
     * Tentukan apakah pengguna dapat menghapus model Siswa.
     */
    public function delete(User $user, Siswa $siswa)
    {
        // Admin sudah diizinkan oleh before().
        return false;
    }
}