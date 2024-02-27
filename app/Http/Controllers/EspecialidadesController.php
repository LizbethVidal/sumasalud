<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageEspecialidadRequest;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EspecialidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $especialidades = Especialidad::query();

        if ($request->has('nombre')) {
            $especialidades->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $especialidades = $especialidades->get();

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

            $validator = Validator::make($request->all(), [
                'nombre' => 'required|unique:especialidades,nombre'
            ], [
                'nombre.required' => 'El nombre de la especialidad es requerido',
                'nombre.unique' => 'La especialidad ya existe'
            ]);

            if ($validator->fails()) {
                return redirect()->route('especialidades.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $especialidad = new Especialidad();
            $especialidad->nombre = $request->nombre;
            $especialidad->save();

            DB::commit();
            Alert::success('Especialidad creada correctamente');
            return redirect()->route('especialidades.index')->with('success', 'Especialidad creada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error al crear la especialidad');
            return redirect()->route('especialidades.create')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidad $especialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialidad $especialidad)
    {
        return view('modules.especialidades.edit', compact('especialidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        DB::beginTransaction();

        try {
            $especialidad->fill($request->all());
            $especialidad->save();

            DB::commit();
            Alert::success('Especialidad actualizada correctamente');
            return redirect()->route('especialidades.index')->with('success', 'Especialidad actualizada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error($th->getMessage(),'Error al actualizar la especialidad');
            return redirect()->route('especialidades.index')->with('error', 'Error al actualizar la especialidad');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidad $especialidad)
    {
        DB::beginTransaction();

        try {
            $especialidad->delete();
            DB::commit();
            return response()->json(['mensaje' => 'Borrado correctamente'],200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Ha ocurrido un error'],400);
        }
    }
}
