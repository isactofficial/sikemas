<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect('/login');
        }

        // Periksa apakah peran pengguna adalah 'admin'
        if (Auth::user()->role == 'admin') {
            // Jika 'admin', izinkan request untuk melanjutkan
            return $next($request);
        }

        // Jika bukan 'admin', tolak akses dan kembalikan ke halaman utama
        // menampilkan halaman 403 (Forbidden) dengan abort(403);
        abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}
