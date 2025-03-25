<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(['error' => 'Unauthorized. Admin access required.'], 403);
        }

        return redirect('/login')->with('error', 'Unauthorized. Admin access required.');
    }
}