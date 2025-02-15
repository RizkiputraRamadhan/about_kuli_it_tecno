<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    /**
     * Menangani permintaan yang masuk.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (!auth()->check()) {
            Session::put('url.intended', $request->url());
            return redirect()->route('login');
        }

        return $next($request);
    }
}
