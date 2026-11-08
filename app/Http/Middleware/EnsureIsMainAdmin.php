<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsMainAdmin
{
    /**
     * Handle an incoming request.
     * Only the designated permanent Main Admin can proceed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('message', 'Please log in with your Main Admin account to continue.');
        }

        if (!auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized. Only the designated Main Administrator has permission to access Admin Access Management.');
        }

        return $next($request);
    }
}

