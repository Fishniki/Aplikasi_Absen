<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            if (Auth::check() && Auth::user()->role !== 'admin') {
                return redirect()->route('login'); // atau route user sesuai kebutuhan
            }
            return redirect()->route('admin.login-admin');
        }
        return $next($request);
    }
}
