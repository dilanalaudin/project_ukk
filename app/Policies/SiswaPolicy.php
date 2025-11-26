<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiswaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return ($user->role ?? '') === 'admin';
    }

    public function view(User $user, Siswa $siswa)
    {
        return ($user->role ?? '') === 'admin' || $user->id === ($siswa->user_id ?? null);
    }

    public function create(User $user)
    {
        return ($user->role ?? '') === 'admin';
    }

    public function update(User $user, Siswa $siswa)
    {
        return ($user->role ?? '') === 'admin';
    }

    public function delete(User $user, Siswa $siswa)
    {
        return ($user->role ?? '') === 'admin';
    }
}