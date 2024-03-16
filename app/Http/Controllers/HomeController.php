<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->rol == 'paciente'){
            return view('modules.pacientes.home');
        }

        $solicitudes_count = Solicitud::where('estado', 'PENDIENTE')->count();

        return view('home', compact('solicitudes_count'));
    }
}
