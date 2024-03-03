<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->paciente_id == null){
            Alert::error('Error', 'No se ha seleccionado un paciente');
            return redirect()->back();
        }

        $medicos = User::where('rol','medico')->get();
        $paciente = User::find($request->paciente_id);
        return view('modules.citas.create',compact('paciente','medicos','request'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        //
    }

    public function search_paciente(Request $request)
    {
        $pacientes = User::where('rol','paciente')->where('dni',$request->dni)->first();

        if($pacientes == null){
            return response()->json(['status' => 'error', 'message' => 'No se ha encontrado ningun paciente con ese DNI']);
        }
        return response()->json(['status' => 'success', 'data' => $pacientes]);
    }

    public function search(Request $request)
    {
        return view('modules.citas.busqueda');
    }
}
