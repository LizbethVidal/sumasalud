<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermisosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rol = $request->input('rol');

        if(Auth::user()->rol == 'admin'){
            return $next($request);
        }

        if(Auth::user()->rol == 'medico' && $rol == 'paciente'){
            return $next($request);
        }

        if(Auth::user()->rol == $rol){
            return $next($request);
        }

        return redirect()->route('home');
    }
}
