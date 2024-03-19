@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Listado de consultas') }}
                    </div>

                    <div class="card-body">
                        <form action="{{route('consultas.index')}}" method="GET">
                            @csrf
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="fecha">Fecha: </label>
                                    <input type="date" name="fecha" class="form-control" value="{{$request->fecha}}">
                                </div>
                                <div class="col">
                                    <label for="paciente">Paciente: </label>
                                    <input type="text" name="paciente" class="form-control" placeholder="Paciente" value="{{$request->paciente}}">
                                </div>
                                <div class="col">
                                    <label for="tratamiento">Tratamiento: </label>
                                    <select name="tratamiento" class="form-select">
                                        <option value="">Seleccionar tratamiento</option>
                                        @foreach($tratamientos as $tratamiento)
                                            <option value="{{$tratamiento->id}}" {{$tratamiento->id == $request->tratamiento ? 'selected' : ''}}>{{$tratamiento->nombre}}</option>
                                        @endforeach
                                    </select>
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
                        @if(!$agent->isMobile())
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Paciente</th>
                                        <th>Médico</th>
                                        <th>Fecha y hora</th>
                                        <th>Fecha de fin</th>
                                        <th>Tratamiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($consultas as $consulta)
                                        <tr>
                                            <td>{{$consulta->id}}</td>
                                            <td>{{$consulta->paciente->name}}</td>
                                            <td>{{$consulta->doctor->name}}</td>
                                            <td>{{$consulta->cita->fecha_hora}}</td>
                                            <td>{{$consulta->updated_at}}</td>
                                            <td>{{$consulta->tratamiento?->nombre ?? 'Sin tratamiento'}}</td>
                                            <td>
                                                <a href="{{route('consultas.show', $consulta->id)}}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{route('consultas.edit', $consulta->id)}}" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            @foreach($consultas as $consulta)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><strong>Consulta #</strong>{{$consulta->id}}</h5>
                                        <p class="card-text"><strong>Paciente: </strong>{{$consulta->paciente->name}}</p>
                                        <p class="card-text"><strong>Médico: </strong>{{$consulta->doctor->name}}</p>
                                        <p class="card-text"><strong>Fecha y hora: </strong>{{$consulta->cita->fecha_hora}}</p>
                                        <p class="card-text"><strong>Fecha de fin: </strong>{{$consulta->updated_at}}</p>
                                        <p class="card-text"><strong>Tratamiento: </strong>{{$consulta->tratamiento?->nombre ?? 'Sin tratamiento'}}</p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-start gap-3">
                                        <a href="{{route('consultas.show', $consulta->id)}}" class="btn btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{route('consultas.edit', $consulta->id)}}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="d-flex justify-content-center">
                            {{$consultas->links()}}
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
