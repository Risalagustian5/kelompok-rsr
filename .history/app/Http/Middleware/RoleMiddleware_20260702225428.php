<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Jika role user tidak sesuai, tampilkan error 403
        // Bisa pakai multi-role: misalnya "admin|superadmin"
        $allowedRoles = explode('|', $role);
        if (!in_array($user?->role, $allowedRoles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk membuka halaman ini.');
        }

        // Jika lolos semua pengecekan, lanjutkan request
        return $next($request);
    }
}