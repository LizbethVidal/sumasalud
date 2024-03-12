@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Consulta de {{$consulta->paciente->name}}</h5>
                    <a href="{{route('pacientes.show', $consulta->paciente->id)}}" class="btn btn-primary" target="_blank">
                        <i class="bi bi-eye"></i> Ver paciente
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('consultas.update',['consulta' => $consulta->id])}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tratamiento_id" id="tratamiento_id" value="{{$consulta->tratamiento_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start gap-3">
                                    <div>
                                        <label for="tratamiento_text">Tratamiento asignado</label>
                                        <input type="text" name="tratamiento_text" id="tratamiento_text" class="form-control" readonly value="{{$consulta->tratamiento?->nombre}}">
                                    </div>
                                    <div class="d-flex align-items-end">
                                        <button type="button" class="btn btn-warning @if(!$consulta->tratamiento_id) d-none @endif" onclick="$('#tratamiento_id').val('');$('#tratamiento_text').val('');$('#reset_tratamiento').addClass('d-none');" id="reset_tratamiento">Quitar tratamiento</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="observaciones_paciente">Motivo de la consulta</label>
                                <textarea name="observaciones_paciente" id="observaciones_paciente" class="form-control @if($errors->has('observaciones_paciente')) is-invalid @endif" required>{{$consulta->observaciones_paciente}}</textarea>
                                @if($errors->has('observaciones_paciente'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('observaciones_paciente')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 mb-3">
                                <label for="diagnostico">Diagnóstico</label>
                                <textarea name="diagnostico" id="diagnostico" class="form-control @if($errors->has('diagnostico')) is-invalid @endif" required>{{$consulta->diagnostico}}</textarea>
                                @if($errors->has('diagnostico'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('diagnostico')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <hr>
                            <div class="col-md-6 mt-2">
                                <div>
                                    <label for="buscador_tratamiento">Buscar Tratamiento</label>
                                    <input type="text" name="buscador_tratamiento" id="buscador_tratamiento" class="form-control" placeholder="Buscar tratamiento">
                                </div>
                                <div id="tratamientos_encontrados" class="list-group mt-3">

                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center my-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
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
<script type="module">
    $(document).ready(function(){
        $('#buscador_tratamiento').on('input', function(){
            let search = $(this).val();
            if(search.length > 3){
                $.ajax({
                    url: `{{route('tratamientos.busqueda')}}`,
                    data: {
                        search: search
                    },
                    type: 'GET',
                    success: function(response){
                        if(response.status == 'success'){
                            $('#tratamientos_encontrados').empty();

                            if(response.data.length == 0){
                                $('#tratamientos_encontrados').append(`
                                    <div class="list-group-item list-group-item-action">
                                        <h5 class="mb-1">No se encontraron tratamientos</h5>
                                        <a href="{{route('tratamientos.create')}}" class="btn btn-sm btn-success" target="_blank">Crear tratamiento</a>
                                    </div>
                                `);
                            }

                            response.data.forEach(tratamiento => {
                                $('#tratamientos_encontrados').append(`
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">${tratamiento.nombre}</h5>
                                            <small>${tratamiento.duracion} días</small>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between">
                                            <div>
                                                <p class="mb-1">${tratamiento.observaciones}</p>
                                                <small>${tratamiento.tratamiento}</small>
                                            </div>
                                            <div class="d-flex align-items-end">
                                                <button type="button" class="btn btn-sm btn-info" onclick="asignarTratamiento(${tratamiento.id},'${tratamiento.nombre}')">Asignar</button>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            });
                        }
                    }
                });
            }
        });
    });


</script>
<script>
    function asignarTratamiento(id,nombre){
        $('#tratamiento_id').val(id);
        $('#tratamiento_text').val(nombre);
        $('#reset_tratamiento').removeClass('d-none');
    }
</script>

@endsection
