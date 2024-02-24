<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoragePacienteRequest;
use App\Http\Requests\StorageUserRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $pacientes = User::where('rol','paciente');

        if($request->name != ""){
            $pacientes = $pacientes->where('name','like','%'.$request->name.'%');
        }

        if($request->dni != ""){
            $pacientes = $pacientes->where('dni','like','%'.$request->dni.'%');
        }

        if($request->email != ""){
            $pacientes = $pacientes->where('email','like','%'.$request->email.'%');
        }

        if($request->telefono != ""){
            $pacientes = $pacientes->where('telefono','like','%'.$request->telefono.'%');
        }

        $pacientes = $pacientes->get();
        return view('modules.pacientes.index',compact('pacientes', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoragePacienteRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->dni = $request->dni;
        $user->email = $request->email;
        $user->movil = $request->movil;
        $user->rol = 'paciente';
        $user->password = bcrypt($request->password);
        $user->save();
        Alert::success('Paciente creado correctamente');
        return redirect()->route('pacientes.index')->with('success','Paciente creado correctamente');
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
    public function edit($user_id)
    {
        $user = User::find($user_id);
        return view('modules.pacientes.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, $user_id)
    {
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->dni = $request->dni;
        $user->email = $request->email;
        $user->movil = $request->movil;
        $user->save();
        Alert::success('Paciente actualizado correctamente');
        return redirect()->route('pacientes.index')->with('success','Paciente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect()->route('pacientes.index')->with('success','Paciente eliminado correctamente');
    }


}

