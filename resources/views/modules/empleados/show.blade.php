@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/users/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-1">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Empleado</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 d-flex justify-content-center">
                                <div class="mt-2 profile_img">
                                    <img id="preview" src="{{ $user->foto ? asset('storage/' . $user->foto) : '/images/default.png' }}" alt="Foto de Perfil" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" value="{{ $user->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="movil">Teléfono</label>
                                            <input type="text" class="form-control" id="movil" value="{{ $user->movil }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_nac">Fecha de Nacimiento</label>
                                            <input type="text" class="form-control" id="fecha_nac" value="{{ $user->fecha_nac }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dni">DNI</label>
                                            <input type="text" class="form-control" id="dni" value="{{ $user->dni }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 mt-1">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Citas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->citas_paciente as $cita)
                                        <tr>
                                            <td>{{ $cita->fecha }}</td>
                                            <td>{{ $cita->hora }}</td>
                                            <td>{{ $cita->estado }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-1">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Historial Médico</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->tratamientos_paciente as $historial)
                                        <tr>
                                            <td>{{ $historial->fecha }}</td>
                                            <td>{{ $historial->descripcion }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
