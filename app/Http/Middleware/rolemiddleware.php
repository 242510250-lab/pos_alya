<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan pengguna sudah login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role->name;

        // 2. Cek apakah role pengguna ada di dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        // 3. Jika tidak punya akses, kunci dengan error 403 bawaan Laravel yang aman
        return $next($request);
    }
}
 