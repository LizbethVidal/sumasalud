@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h1 class="text-center">Medicos de {{$user->name}}</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card">
                <h5 class="card-header">Nueva asignación</h5>
                <div class="card-body d-flex gap-3 flex-column">
                    <div class="form-group">
                        <label for="especialidad">Especialidad</label>
                        <select class="form-control" id="especialidad">
                            <option value="">Seleccione una especialidad</option>
                            @foreach($especialidades as $especialidad)
                                <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="medico">Médico</label>
                        <select class="form-control" id="medico">
                            <option value="">Seleccione un médico</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" id="asignar">Asignar</button>
                    </div>
                </div>
            </div>
        </div>
        @foreach($medicos as $medico)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <h5 class="card-header">{{$medico->especialidad->nombre}}</h5>
                    <div class="card-body">
                        <p> {{$medico->name}}</p>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
</div>
@endsection
