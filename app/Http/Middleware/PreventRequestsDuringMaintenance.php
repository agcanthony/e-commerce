<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventRequestsDuringMaintenance
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->isDownForMaintenance()) {
            // Retorna uma resposta adequada quando o aplicativo está em modo de manutenção.
            return response('Service Unavailable', 503);
        }

        return $next($request);
    }
}
