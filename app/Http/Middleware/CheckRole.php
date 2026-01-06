<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role ?? '';
        if (!in_array($userRole, $roles)) {
            // Jika admin coba akses /dashboard, redirect ke /admin/dashboard
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            // Jika user lain, return 403
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
