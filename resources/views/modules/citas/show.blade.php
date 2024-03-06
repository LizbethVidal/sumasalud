{{-- Cita - show --}}
@extends('layouts.app')

@section('content')
    <div class="px-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div>
                            {{ __('Cita') }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="text" class="form-control" id="fecha" name="fecha" value="{{$cita->fecha_hora}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6  d-flex flex-column justify-content-end">
                                @switch($cita->estado)
                                    @case('ATENDIDA')
                                        <button type="button" class="btn btn-warning">Atendida</span>
                                        @break
                                    @case('CANCELADA')
                                        <button type="button" class="btn btn-danger">Cancelada</span>
                                        @break
                                    @case('CONFIRMADA')
                                        <button type="button" class="btn btn-info">Confirmada</span>
                                        @break
                                    @case('ESPERA')
                                        <button type="button" class="btn btn-success">En espera</span>
                                        @break
                                    @default
                                        <button type="button" class="btn btn-secondary">Sin estado</span>
                                @endswitch
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paciente">Paciente</label>
                                    <input type="text" class="form-control" id="paciente" name="paciente" value="{{$cita->paciente->name}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="medico">Médico</label>
                                    <input type="text" class="form-control" id="medico" name="medico" value="{{$cita->doctor->name}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo</label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="3" readonly>{{$cita->motivo}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{route('citas.index')}}" class="btn btn-outline-dark">
                        <i class="bi bi-arrow-left-circle"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
