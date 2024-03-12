<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudes = Solicitud::query();

        $solicitudes = $solicitudes->where('estado', 'PENDIENTE');

        $solicitudes = $solicitudes->paginate(10);

        return view('modules.solicitudes.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($paciente_id)
    {
        $paciente = User::find($paciente_id);
        $especialidades = Especialidad::where('nombre', '!=', 'General')->get();
        return view('modules.solicitudes.create', compact('paciente', 'especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $solicitud = new Solicitud();
            $solicitud->fill($request->all());
            $solicitud->estado = 'PENDIENTE';
            $solicitud->doctor_id = Auth()->user()->id;
            $solicitud->save();

            DB::commit();
            Alert::success('Solicitud creada correctamente');
            return redirect()->route('pacientes.index')->with('success', 'Solicitud creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al crear la solicitud');
            return redirect()->back()->with('error', 'Error al crear la solicitud');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
