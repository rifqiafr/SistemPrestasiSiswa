<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login')
                ->with('error', 'Silakan masuk terlebih dahulu untuk mengakses Panel Operator.');
        }

        if (! ($request->user()->isOperator() || $request->user()->isSuperAdmin())) {
            return redirect()->route('home')
                ->with('error', 'Akses ditolak. Panel ini khusus untuk Operator dan Staf Kesiswaan.');
        }

        return $next($request);
    }
}
