<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Siswa;
use App\Policies\SiswaPolicy;

class AuthServiceProvider extends ServiceProvider
{
      protected $policies = [
        // ...existing mappings...
        \App\Models\Siswa::class => \App\Policies\SiswaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Gate untuk middleware can:isAdmin
        Gate::define('isAdmin', fn($user) => $user && ($user->role ?? '') === 'admin');
    }
}