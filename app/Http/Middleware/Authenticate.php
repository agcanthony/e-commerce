<?php
// app/Http/Middleware/Authenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (!Session::get('authenticated')) {
            return redirect('/login');
        }

        return $next($request);
    }
}