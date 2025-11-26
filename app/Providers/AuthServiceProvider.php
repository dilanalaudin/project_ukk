<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Siswa;
use App\Policies\SiswaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Siswa::class => SiswaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', fn ($user) => ($user->role ?? '') === 'admin');
    }
}