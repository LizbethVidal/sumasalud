<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Consultas;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $consultas = Consulta::query();

        if(Auth()->user()->rol == 'medico'){
            $consultas = $consultas->where('doctor_id',Auth()->user()->id);
        }

        if($request->fecha != ""){
            $consultas = $consultas->whereHas('cita', function($query) use ($request){
                $query->where('fecha_hora', 'like', "%{$request->fecha}%");
            });
        }
        if($request->paciente != ""){
            $consultas = $consultas->whereHas("paciente", function($query) use ($request){
                $query->where('name', 'like', "%{$request->paciente}%");
            });
        }
        if($request->tratamiento != ""){
            $consultas = $consultas->where("tratamiento_id", $request->tratamiento);
        }

        $consultas = $consultas->paginate(10);

        $tratamientos = Tratamiento::all();

        return view('modules.consultas.index', compact('consultas', 'request', 'tratamientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cita_id)
    {
        $cita = Cita::find($cita_id);

        return view('modules.consultas.create', compact('cita'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $consulta = new Consulta();
            $consulta->fill($request->all());
            $consulta->doctor_id = Auth()->user()->id;
            $consulta->save();

            $cita = Cita::find($request->cita_id);
            $cita->estado = 'ATENDIDA';
            $cita->save();

            DB::commit();
            Alert::success('Consulta creada correctamente');
            return redirect()->route('citas.index')->with('success', 'Consulta creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al crear la consulta');
            return redirect()->back()->with('error', 'Error al crear la consulta');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Consulta $consulta)
    {
        return view('modules.consultas.show', compact('consulta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consulta $consulta)
    {
        return view('modules.consultas.edit', compact('consulta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consulta $consulta)
    {
        DB::beginTransaction();

        try {
            $consulta->fill($request->all());
            $consulta->save();

            DB::commit();
            Alert::success('Consulta actualizada correctamente');
            return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al actualizar la consulta');
            return redirect()->back()->with('error', 'Error al actualizar la consulta');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consulta $consulta)
    {
        //
    }
}
