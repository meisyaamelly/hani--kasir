<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
{
    if (!session('user') && !$request->expectsJson()) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    return $next($request);
}

}
