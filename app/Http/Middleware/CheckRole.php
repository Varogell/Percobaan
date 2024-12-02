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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan user sudah login dan memiliki role yang sesuai
        if (auth()->check() && auth()->user()->role !== $role) {
            // Redirect ke halaman utama jika role tidak sesuai
            return redirect('/')->with('error', 'You do not have access to this page.');
        }

        return $next($request);
    }
}
