@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Solicitudes</h5>
                    <div class="card-body">
                            <a href="{{route('solicitudes.index')}}?canceladas=true" class="btn btn-outline-danger">
                                <i class="bi bi-x-circle"></i> Ver canceladas
                            </a>
                            <a href="{{route('solicitudes.index')}}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-repeat"></i> Ver pendientes
                            </a>
                            <a href="{{route('solicitudes.index')}}?atendidas=true" class="btn btn-outline-success">
                                <i class="bi bi-check-circle"></i> Ver finalizadas
                            </a>
                            <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Especialidad</th>
                                        <th>Motivo</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($solicitudes as $solicitud)
                                        <tr>
                                            <td>{{$solicitud->created_at->format('d/m/Y')}}</td>
                                            <td>{{$solicitud->paciente->name}}</td>
                                            <td>{{$solicitud->especialidad->nombre}}</td>
                                            <td>{{$solicitud->descripcion}}</td>
                                            <td>{{$solicitud->prioridad}}</td>
                                            <td>
                                                @if($solicitud->estado == 'PENDIENTE')
                                                    <span class="badge bg-warning text-dark">{{$solicitud->estado}}</span>
                                                @elseif($solicitud->estado == 'ATENDIDA')
                                                    <span class="badge bg-success">{{$solicitud->estado}}</span>
                                                @else
                                                    <span class="badge bg-danger">{{$solicitud->estado}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start gap-3">
                                                    @if($solicitud->estado == 'PENDIENTE')
                                                        <a href="{{route('citas.create', ['paciente_id' => $solicitud->paciente_id, 'especialidad_id' => $solicitud->especialidad_id, 'solicitud_id' => $solicitud->id])}}" class="btn btn-success">
                                                            <i class="bi bi-calendar-plus"></i> Agendar cita
                                                        </a>
                                                        <form action="{{route('solicitudes.update', $solicitud->id)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="estado" value="CANCELADA">
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-x-circle"></i> CANCELAR
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if($solicitud->estado == 'CANCELADA')
                                                        <form action="{{route('solicitudes.update', $solicitud->id)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="estado" value="PENDIENTE">
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="bi bi-arrow-repeat"></i> Reestablecer
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
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
