@extends('layouts.app')

@section('content')
<div class="px-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{ __('Citas') }}
                    </div>
                    <div>
                        <a href="{{route('citas.busqueda')}}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Crear Cita</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('citas.index')}}" method="GET">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$request->name}}">
                            </div>
                            <div class="col-md-2">
                                <label for="dni">DNI</label>
                                <input type="text" name="dni" id="dni" class="form-control" value="{{$request->dni}}">
                            </div>
                            <div class="col-md-2">
                                <label for="movil">Teléfono</label>
                                <input type="text" name="movil" id="movil" class="form-control" value="{{$request->movil}}">
                            </div>
                            <div class="col-md-2">
                                <label for="email">Correo</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{$request->email}}">
                            </div>
                            <div class="col-md-2">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" value="{{$request->fecha}}">
                            </div>
                            <div class="col d-flex flex-column justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success" >
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Fecha y hora</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Paciente</th>
                                    <th scope="col">Médico</th>
                                    <th scope="col">Motivo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($citas as $cita)
                                    <tr>
                                        @if($cita->estado == 'ESPERA')
                                            <td>
                                                <span class="badge bg-warning text-dark">Pendiente cita por videollamada</span>
                                            </td>
                                        @else
                                            <td>{{$cita->fecha_hora}}</td>
                                        @endif
                                        <td>
                                            @if($cita->estado == 'ATENDIDO')
                                                <span class="badge bg-success">Atendido</span>
                                            @elseif($cita->estado == 'CANCELADO')
                                                <span class="badge bg-danger">Cancelado</span>
                                            @elseif($cita->estado == 'CONFIRMADA')
                                                <span class="badge bg-info">Confirmada</span>
                                            @else
                                                <span class="badge bg-warning text-dark">En espera</span>
                                            @endif
                                        </td>
                                        <td>{{$cita->paciente->name}}</td>
                                        <td>{{$cita->doctor->name}}</td>
                                        <td>{{$cita->motivo}}</td>
                                        <td>
                                            <a href="{{route('citas.edit', $cita->id)}}" class="btn btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{route('citas.destroy', $cita->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{route('home')}}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
