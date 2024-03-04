<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmpleadoRequest;
use App\Http\Requests\StorageUserRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
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
        $empleados = User::where('rol','<>','paciente');

        if($request->name != ''){
            $users = $empleados->where('name','like',"%$request->name%");
        }

        if($request->dni != ''){
            $empleados = $empleados->where('dni',$request->dni);
        }

        if($request->rol != ''){
            $empleados = $empleados->where('rol',$request->rol);
        }

        if($request->movil != ''){
            $empleados = $empleados->where('movil',$request->movil);
        }

        if($request->email != ''){
            $empleados = $empleados->where('email',$request->email);  //duda: ¿debería ir like?
        }



        // dd($empleados->toRawSql());

        $empleados = $empleados->paginate(10);
        return view('modules.empleados.index', compact('empleados', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorageUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->fill($request->validated());
            $user->password = bcrypt($request->password);
            $user->save();

            if ($request->hasFile('foto')) {
                $path = Storage::disk('public')->put("users/$user->id", $request->file('foto'));
                $user->foto = $path;
                $user->save();
            }

            DB::commit();
            Alert::success('Usuario creado correctamente');
            return redirect()->route('home')->with('success', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al crear el usuario');
            return redirect()->route('users.create')->with('error', 'Error al crear el usuario');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('modules.empleados.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        switch ($user->rol) {
            case 'medico':
                return redirect()->route('medicos.edit', $user);
                break;
            case 'admin':
                return view('modules.empleados.edit', compact('user'));
                break;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadoRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->fill($request->all());
            $user->save();

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
            Alert::success('Medico actualizado correctamente');
            return redirect()->route('empleados.index')->with('success', 'Medico actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al actualizar el medico');
            return redirect()->route('medicos.edit', $user)->with('error', 'Error al actualizar el medico');
        }
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
