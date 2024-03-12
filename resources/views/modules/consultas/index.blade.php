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
                        <form action="{{route('especialidades.index')}}" method="GET">
                            @csrf
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$request->nombre}}">
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
