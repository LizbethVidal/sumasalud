<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $especialidades = Especialidad::all();
        return view('modules.especialidades.index', compact('especialidades','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $especialidad = new Especialidad();
            $especialidad->nombre = $request->nombre;
            $especialidad->save();

            DB::commit();
            Alert::success('Especialidad creada correctamente');
            return redirect()->route('especialidades.index')->with('success', 'Especialidad creada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error al crear la especialidad');
            return redirect()->route('especialidades.index')->with('error', 'Error al crear la especialidad');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidad $especialidades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialidad $especialidades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidad $especialidades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidad $especialidades)
    {
        //
    }
}
