<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Pemakaian di routes:
     *   middleware('role:admin')
     *   middleware('role:user')
     *   middleware('role:admin,user')   ← boleh lebih dari satu role
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $userRole = Auth::user()->role;

        // Cek apakah role user ada di daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Redirect ke halaman sesuai role masing-masing
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Akses ditolak.');
            }

            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak. Halaman ini khusus admin.');
        }

        return $next($request);
    }
}