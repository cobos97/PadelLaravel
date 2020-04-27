<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Penalizado
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $penalizacion = Auth()->user()->penalizacion;

        if ($penalizacion > time()) {
            return redirect()->route('penalizado');
        }

        return $next($request);
    }
}
