<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses Dashboard Siswa.');
        }

        // Allow students (and administrators/operators for previewing)
        if ($request->user()->isSiswa() || $request->user()->student || $request->user()->isSuperAdmin() || $request->user()->isOperator()) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Akses terbatas untuk akun siswa.');
    }
}
