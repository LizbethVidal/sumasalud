<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $citas = Cita::query();

        if($request->name != ""){
            $citas = $citas->whereHas('paciente',function($query) use ($request){
                $query->where('name','like','%'.$request->name.'%');
            });
        }

        if($request->dni != ""){
            $citas = $citas->whereHas('paciente',function($query) use ($request){
                $query->where('dni','like','%'.$request->dni.'%');
            });
        }

        if($request->telefono != ""){
            $citas = $citas->whereHas('paciente',function($query) use ($request){
                $query->where('movil','like','%'.$request->telefono.'%');
            });
        }

        if($request->email != ""){
            $citas = $citas->whereHas('paciente',function($query) use ($request){
                $query->where('email','like','%'.$request->email.'%');
            });
        }

        if($request->fecha != ""){
            $citas = $citas->whereDate('fecha_hora',$request->fecha);
        }

        $citas = $citas->paginate(10);

        return view('modules.citas.index',compact('citas','request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->paciente_id == null){
            Alert::error('Error', 'No se ha seleccionado un paciente');
            return redirect()->back();
        }

        $medicos = User::where('rol','medico')->get();
        $paciente = User::find($request->paciente_id);
        return view('modules.citas.create',compact('paciente','medicos','request'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $cita = new Cita();
            if($request->en_espera == '1'){
                $cita->estado = 'ESPERA';
            }elseif($request->fecha_hora != null){
                $cita->fecha_hora = Carbon::parse($request->fecha_hora)->format('Y-m-d H:i:s');
                $cita->estado = 'CONFIRMADA';
            }else{
                Alert::error('Error', 'No se ha seleccionado una fecha y hora');
                return redirect()->back();
            }
            $cita->paciente_id = $request->paciente_id;
            $cita->doctor_id = $request->medico;
            $cita->motivo = $request->motivo;
            $cita->save();
            DB::commit();
            Alert::success('Exito', 'Cita creada correctamente');
            return redirect()->route('citas.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'No se ha podido crear la cita');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        //
    }

    public function search_paciente(Request $request)
    {
        $pacientes = User::where('rol','paciente')->where('dni',$request->dni)->first();

        if($pacientes == null){
            return response()->json(['status' => 'error', 'message' => 'No se ha encontrado ningun paciente con ese DNI']);
        }
        return response()->json(['status' => 'success', 'data' => $pacientes]);
    }

    public function search(Request $request)
    {
        return view('modules.citas.busqueda');
    }
}
