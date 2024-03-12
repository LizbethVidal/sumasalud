<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermisosMiddleware
{
    /**
     * Handle an incoming request. premisos:admin,medico,paciente
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles) : Response
    {

        $rol = Auth::user()->rol;

        if(in_array($rol, $roles)){
            return $next($request);
        }

        //Salvo si es consultas.create o consultas.edit, que solo pueden ser creadas por medicos
        if($request->route()->getName() == 'consultas.create' || $request->route()->getName() == 'consultas.edit'){
            if($rol == 'medico'){
                return $next($request);
            }
            return redirect()->route('home');
        }

        if($rol == 'admin'){
            return $next($request);
        }

        if($rol == 'medico' && in_array('paciente', $roles)){
            return $next($request);
        }

        return redirect()->route('home');
    }
}
