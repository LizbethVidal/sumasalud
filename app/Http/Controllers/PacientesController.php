<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoragePacienteRequest;
use App\Http\Requests\StorageUserRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $pacientes = $pacientes->paginate(10);

        return view('modules.pacientes.index',compact('pacientes', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicos = User::where('rol','medico')->whereHas('especialidad',function($query){
            $query->where('nombre','General');
        })->get();

        return view('modules.pacientes.create',compact('medicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoragePacienteRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->fill($request->validated());
            $user->rol = 'paciente';
            $user->password = bcrypt($request->password);
            $user->save();

            if($request->medico_id != null){
                $user->doctores()->attach($request->medico_id, ['doctor_principal' => 1]);
            }

            if ($request->hasFile('foto')) {
                $path = Storage::disk('public')->put("users/$user->id", $request->file('foto'));
                $user->foto = $path;
                $user->save();
            }

            DB::commit();
            Alert::success('Paciente creado correctamente');
            return redirect()->route('pacientes.index')->with('success', 'Paciente creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al crear el paciente',$e->getMessage());
            return redirect()->route('pacientes.create')->with('error', 'Error al crear el Paciente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('modules.pacientes.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $medicos = User::where('rol','medico')->whereHas('especialidad',function($query){
            $query->where('nombre','General');
        })->get();

        $medicos = $medicos->filter(function($medico){
            return $medico->pacientes->count() < 5;
        });

        return view('modules.pacientes.edit',compact('user','medicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->fill($request->all());
            $user->save();

            if($request->medico_id != null){
                $user->doctores()->attach($request->medico_id, ['doctor_principal' => 1]);
            }

            if ($request->hasFile('foto')) {
                // Eliminar foto anterior
                if ($user->foto) {
                    Storage::disk('public')->delete($user->foto);
                }
                $path = Storage::disk('public')->put("users/$user->id", $request->file('foto'));
                $user->foto = $path;
                $user->save();
            }

            DB::commit();
            Alert::success('Usuario actualizado correctamente');
            return redirect()->route('pacientes.index')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al actualizar el usuario');
            return redirect()->route('pacientes.edit', $user)->with('error', 'Error al actualizar el usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('pacientes.index')->with('success','Paciente eliminado correctamente');
    }

    public function medicos_paciente($paciente_id)
    {
        $user = User::find($paciente_id);
        $medicos = $user->doctores;

        $especialidades = Especialidad::all();

        return view('modules.pacientes.medicos_paciente',compact('user','medicos','especialidades'));
    }
}

