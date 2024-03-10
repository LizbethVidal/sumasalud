@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Editar Tratamiento</h5>
                    <div class="card-body">
                        <form action="{{ route('tratamientos.update', $tratamiento->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$tratamiento->nombre}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duracion">Duración (días)</label>
                                        <input type="number" class="form-control" id="duracion" name="duracion" value="{{$tratamiento->duracion}}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{$tratamiento->observaciones}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tratamiento">Tratamiento</label>
                                        <textarea class="form-control" id="tratamiento" name="tratamiento" rows="3" >{{$tratamiento->tratamiento}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
