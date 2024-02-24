<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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

        if($request->rol != ''){
            $users = $users->where('rol',$request->rol);
        }

        if($request->movil != ''){
            $users = $users->where('movil',$request->movil);
        }

        if($request->email != ''){
            $users = $users->where('email',$request->email);  //duda: ¿debería ir like?
        }



        // dd($users->toRawSql());

        $users = $users->paginate(2);

        return view('modules.users.index', compact('users','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.users.create');
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
                $path = Storage::disk('public')->put('users', $request->file('foto'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('modules.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
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
                $path = Storage::disk('public')->put('users', $request->file('foto'));
                $user->foto = $path;
                $user->save();
            }

            DB::commit();
            Alert::success('Usuario actualizado correctamente');
            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error al actualizar el usuario');
            return redirect()->route('users.edit', $user)->with('error', 'Error al actualizar el usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {

            if ($user->foto) {
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

    public function search_tutor(Request $request)
    {
        $tutors = User::where('dni', 'like', '%'.$request->tutor_search.'%')
        ->where('tutor_id', null)
        ->where('rol','paciente')
        ->where('id', '<>',$request->user_id)
        ->get();

        return response()->json(['tutors' => $tutors],200);
    }
}
