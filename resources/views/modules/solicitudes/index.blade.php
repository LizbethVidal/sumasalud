@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Solicitudes</h5>
                    <div class="card-body">
                        <div class="d-flex justify-content-start gap-3">
                            <a href="{{route('solicitudes.index')}}?canceladas=true" class="btn btn-outline-danger">
                                <i class="bi bi-x-circle"></i> Ver canceladas
                            </a>
                            <a href="{{route('solicitudes.index')}}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-repeat"></i> Ver pendientes
                            </a>
                            <a href="{{route('solicitudes.index')}}?atendidas=true" class="btn btn-outline-success">
                                <i class="bi bi-check-circle"></i> Ver finalizadas
                            </a>
                        </div>
                        @if(!$agent->isMobile())
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
                        @else
                            <div class="accordion mt-3" id="accordionExample">
                                @foreach($solicitudes as $solicitud)
                                    <div class="accordion-item my-3">
                                        <h2 class="accordion-header" id="heading{{$solicitud->id}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$solicitud->id}}" aria-expanded="true" aria-controls="collapse{{$solicitud->id}}">
                                                <div class="d-flex justify-content-between w-100">
                                                    <span>{{$solicitud->paciente->name}}</span>
                                                    <span>
                                                        @if($solicitud->estado == 'PENDIENTE')
                                                            <span class="badge bg-warning text-dark">{{$solicitud->estado}}</span>
                                                        @elseif($solicitud->estado == 'ATENDIDA')
                                                            <span class="badge bg-success">{{$solicitud->estado}}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{$solicitud->estado}}</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse{{$solicitud->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$solicitud->id}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="d-flex justify-content-between gap-3">
                                                    <span>Fecha: {{$solicitud->created_at->format('d/m/Y')}}</span>
                                                    <span>Especialidad: {{$solicitud->especialidad->nombre}}</span>
                                                </div>
                                                <div class="d-flex justify-content-between gap-3">
                                                    <span>Motivo: {{$solicitud->descripcion}}</span>
                                                    <span>Prioridad: {{$solicitud->prioridad}}</span>
                                                </div>
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
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

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
