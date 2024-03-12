@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Solicitud de especialista para {{$paciente->name}}</h5>
                <div class="card-body">
                    <form action="{{route('solicitudes.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="paciente_id" value="{{$paciente->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="especialidad_id">Especialidad</label>
                                    <select name="especialidad_id" id="especialidad_id" class="form-control @error('especialidad_id') is-invalid @enderror" required>
                                        <option value="">Seleccione una especialidad</option>
                                        @foreach($especialidades as $especialidad)
                                            <option value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('especialidad_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prioridad">Prioridad</label>
                                    <select name="prioridad" id="prioridad" class="form-control @error('prioridad') is-invalid @enderror" required>
                                        <option value="">Seleccione una prioridad</option>
                                        <option value="baja">Baja</option>
                                        <option value="media">Media</option>
                                        <option value="alta">Alta</option>
                                    </select>
                                    @error('prioridad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" required>{{old('descripcion')}}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{route('pacientes.index')}}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
