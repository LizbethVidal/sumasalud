@extends('layouts.app')

@section('content')

<div class="px-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Listado de especialidades') }}
                </div>

                <div class="card-body">
                    <form action="{{route('especialidades.index')}}" method="GET">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-2">
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
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($especialidades as $especialidad)
                                <tr>
                                    <td>{{$especialidad->id}}</td>
                                    <td>{{$especialidad->nombre}}</td>
                                    <td>
                                        <a href="{{route('especialidades.edit', $especialidad->id)}}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{route('especialidades.destroy', $especialidad->id)}}" method="POST" class="d-inline">
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
            <div class="mt-3">
                <a href="{{route('home')}}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
