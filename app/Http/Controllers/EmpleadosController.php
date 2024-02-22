<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $empleados = User::where('rol','<>','paciente')->get();
        return view('modules.empleados.index', compact('empleados', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        DB::beginTransaction();
        $user = User::find($user_id);
        
        try {
            if($user->foto){
                Storage::disk('public')->delete($user->foto);
            }

            $user->delete();
            DB::commit();
            return response()->json(['mensaje' => 'Borrado correctamente'],200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Ha ocurrido un error'],400);
        }
    }
}
