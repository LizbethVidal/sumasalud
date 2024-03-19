<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMedicoRequest;
use App\Http\Requests\StorageUserRequest;
use App\Models\Especialidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //dd($request->all());
        $users = User::query();
        // Select * from users;

        if($request->name != ''){
            $users = $users->where('name','like',"%$request->name%");
        }

        if($request->dni != ''){
            $users = $users->where('dni',$request->dni);
        }

        if($request->movil != ''){
            $users = $users->where('movil',$request->movil);
        }

        if($request->email != ''){
            $users = $users->where('email',$request->email);  //duda: ¿debería ir like?
        }



        // dd($users->toRawSql());

        $users = $users->paginate(10);

        return view('modules.medicos.index', compact('users','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $especialidades = Especialidad::all();
        return view('modules.medicos.create',compact('especialidades'));
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
            $user->rol = 'medico';
            $user->save();

            if ($request->hasFile('foto')) {
                $path = Storage::disk('public')->put("users/$user->id", $request->file('foto'));
                $user->foto = $path;
                $user->save();
            }

            DB::commit();
            Alert::success('Medico creado correctamente');
            return redirect()->route('medicos.index')->with('success', 'Medico creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al crear el medico');
            return redirect()->route('medicos.create')->with('error', 'Error al crear el medico');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('modules.medicos.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $especialidades = Especialidad::all();
        return view('modules.medicos.edit',compact('user','especialidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicoRequest $request, User $user)
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
            return redirect()->route('empleados.edit', $user)->with('error', 'Error al actualizar el medico');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('empleados.index')->with('success','Médico eliminado correctamente');
    }

    public function calendario($user_id)
    {
        $user = User::find($user_id);
        $fecha_search = Carbon::now()->subDays(1)->format('Y-m-d');
        $citas = $user->citas_doctor()->where('fecha_hora','>=',$fecha_search)->where('estado','<>','CANCELADA')->where('estado','<>','ATENDIDA')->get();

        return view('modules.medicos.calendario',compact('user','citas'));
    }

    public function get_medicos(Request $request)
    {
        $medicos = User::where('rol','medico')->whereHas('especialidad',function($query) use ($request){
            $query->where('especialidad_id',$request->especialidad_id);
        })->get();
        return response()->json(['medicos' => $medicos, 'status' => 'success']);
    }
}
