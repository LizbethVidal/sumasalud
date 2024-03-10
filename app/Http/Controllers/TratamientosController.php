<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Tratamientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TratamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tratamientos = Tratamiento::query();

        if ($request->has('nombre')) {
            $tratamientos->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        $tratamientos = $tratamientos->paginate(10);

        return view('modules.tratamientos.index', compact('tratamientos', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.tratamientos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $tratamiento = new Tratamiento();
            $tratamiento->fill($request->all());
            $tratamiento->save();

            DB::commit();
            Alert::success('Tratamiento creado correctamente');
            return redirect()->route('tratamientos.index')->with('success', 'Tratamiento creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al crear el tratamiento');
            return redirect()->back()->with('error', 'Error al crear el tratamiento');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tratamiento $tratamiento)
    {
        return view('modules.tratamientos.show', compact('tratamiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tratamiento $tratamiento)
    {
        return view('modules.tratamientos.edit', compact('tratamiento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tratamiento $tratamiento)
    {
        DB::beginTransaction();

        try {
            $tratamiento->fill($request->all());
            $tratamiento->save();

            DB::commit();
            Alert::success('Tratamiento actualizado correctamente');
            return redirect()->route('tratamientos.index')->with('success', 'Tratamiento actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al actualizar el tratamiento');
            return redirect()->back()->with('error', 'Error al actualizar el tratamiento');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tratamiento $tratamiento)
    {
        DB::beginTransaction();

        try {
            $tratamiento->delete();

            DB::commit();
            Alert::success('Tratamiento eliminado correctamente');
            return redirect()->route('tratamientos.index')->with('success', 'Tratamiento eliminado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al eliminar el tratamiento');
            return redirect()->back()->with('error', 'Error al eliminar el tratamiento');
        }
    }
}
