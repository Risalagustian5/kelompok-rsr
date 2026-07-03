<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // ✅ Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
        }

        // ✅ Pastikan role sesuai
        $userRole = Auth::user()->role ?? null;
        if ($userRole !== $role) {
            abort(403, 'Akses ditolak. Dibutuhkan role: ' . $role);
        }

        return $next($request);
    }
}
