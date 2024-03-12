@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/modules/users/index.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Paciente</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 d-flex justify-content-center">
                                <div class="mt-2 profile_img">
                                    <img id="preview" src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('storage/users/default.png') }}" alt="Foto de Perfil" class="img-thumbnail" style="max-width: 200px;">
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
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" value="{{ $user->telefono }}" readonly>
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
                                    @if($user->tutor)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tutor">Tutor</label>
                                                <input type="text" class="form-control" id="tutor" value="{{ $user->tutor->name }}" readonly>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-1">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Citas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha y hora</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->citas_paciente as $cita)
                                        <tr>
                                            <td>{{ $cita->fecha_hora }}</td>
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
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->consultas_paciente as $historial)
                                        <tr>
                                            <td>{{ $historial->created_at }}</td>
                                            <td>{{ $historial->observaciones_paciente }}</td>
                                            <td>
                                                <a href="{{ route('consultas.show', $historial->id) }}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
