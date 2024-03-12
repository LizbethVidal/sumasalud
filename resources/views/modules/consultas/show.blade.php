@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Consulta de {{$consulta->paciente->name}}</h5>
                <div class="card-body">
                    <input type="hidden" name="tratamiento_id" id="tratamiento_id" value="{{$consulta->tratamiento_id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-start gap-3">
                                <div>
                                    <label for="tratamiento_text">Tratamiento asignado</label>
                                    <input type="text" name="tratamiento_text" id="tratamiento_text" class="form-control" readonly value="{{$consulta->tratamiento?->nombre}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="observaciones_paciente">Motivo de la consulta</label>
                            <textarea name="observaciones_paciente" id="observaciones_paciente" class="form-control" readonly>{{$consulta->observaciones_paciente}}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="diagnostico">Diagnóstico</label>
                            <textarea name="diagnostico" id="diagnostico" class="form-control" readonly>{{$consulta->diagnostico}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{route('consultas.index')}}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
