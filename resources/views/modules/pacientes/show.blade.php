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
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
                        </div>
                        <div>
                            @if(Auth::user()->hasRole('admin'))
                                <a href="{{ route('pacientes.edit', $user->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{route('pacientes.medicos_paciente', ['paciente' => $user->id])}}" class="btn btn-info" title="Ver Médicos">
                                    <i class="bi bi-people"></i>
                                </a>
                            @endif
                            <a href="{{ route('pacientes.solicitar_cita', ['paciente_id' => $user->id])}}" class="btn btn-success" title="Crear Cita">
                                <i class="bi bi-calendar-plus"></i>
                            </a>
                            @if(Auth::user()->hasRole('medico'))
                                <a href="{{route('solicitudes.create', ['paciente' => $user->id])}}" class="btn btn-secondary" title="Solicitar especialista">
                                    <i class="bi bi-chat-dots"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            @if(count($user->personas_cargo) > 0)
                <div class="col-12 my-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Personas a Cargo</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            @foreach($user->personas_cargo as $persona)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">{{ $persona->name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            {{-- Acciones del paciente --}}
                                            <a href="{{ route('pacientes.show', $persona->id) }}" class="btn btn-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if(Auth::user()->hasRole('admin'))
                                                <a href="{{ route('pacientes.edit', $persona->id) }}" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="{{route('pacientes.medicos_paciente', ['paciente' => $persona->id])}}" class="btn btn-info" title="Ver Médicos">
                                                    <i class="bi bi-people"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('pacientes.solicitar_cita', ['paciente_id' => $persona->id])}}" class="btn btn-success" title="Crear Cita">
                                                <i class="bi bi-calendar-plus"></i>
                                            </a>
                                            @if(Auth::user()->hasRole('medico'))
                                                <a href="{{route('solicitudes.create', ['paciente' => $persona->id])}}" class="btn btn-secondary" title="Solicitar especilista">
                                                    <i class="bi bi-chat-dots"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12 my-2">
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
                                    @foreach($user->historial_citas() as $cita)
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

            @if($user->alergias)
                <div class="col-md-6 mt-1">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Alergias</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($user->alergias as $alergia)
                                <div class="btn btn-danger" role="alert">
                                    {{ $alergia }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
