@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

            <div class="col-md-3 my-3 my-md-0">
                <div class="card">
                    <div class="card-header">{{ __('General') }}</div>

                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-start gap-3 flex-column">
                                @if(Auth::user()->rol == 'admin' )
                                    <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuarios</a>
                                    <a href="{{ route('empleados.index')}}" class="btn btn-primary"> Ver Empleados</a>
                                    <a href="{{ route('empleados.index')}}?rol=medico" class="btn btn-primary"> Ver Médicos</a>
                                @endif
                                <a href="{{ route('pacientes.index')}}" class="btn btn-primary"> Ver Pacientes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3 my-md-0">
                <div class="card">
                    <div class="card-header">{{ __('Especialidades') }}</div>

                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-start gap-3 flex-column">
                                @if(Auth::user()->rol == 'admin' )
                                    <a href="{{ route('especialidades.create') }}" class="btn btn-primary">Crear Especialidad</a>
                                @endif
                                <a href="{{ route('especialidades.index') }}" class="btn btn-primary">Ver Especialidades</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">{{ __('Consultas') }}</div>
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-start gap-3 flex-column">
                                <a href="{{ route('consultas.index') }}" class="btn btn-primary">Ver Consultas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @if(Auth::user()->rol != 'paciente')
            <div class="col-md-3 my-3 my-md-0">
                <div class="card">
                    <div class="card-header">{{ __('Citas') }}</div>

                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-start gap-3 flex-column">
                                <a href="{{ route('citas.busqueda') }}" class="btn btn-primary">Crear cita</a>
                                <a href="{{ route('citas.index') }}" class="btn btn-primary">Ver citas</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        Tratamientos
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start gap-3 flex-column">
                            <a href="{{ route('tratamientos.create') }}" class="btn btn-primary">Crear Tratamiento</a>
                            <a href="{{ route('tratamientos.index') }}" class="btn btn-primary">Ver Tratamientos</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>



<script type="module">
    $(document).ready(function(){
        $('#dni_paciente').on('input', function(){
            let dni = $(this).val();
            if(dni.length == 9){
                $.ajax({
                    url: `{{route('citas.paciente')}}?dni=${dni}`,
                    type: 'GET',
                    success: function(response){
                        if(response.status == 'success'){
                            $('#dni_paciente').removeClass('is-invalid');
                            $('#dni_paciente').addClass('is-valid');
                            $('#nombre_paciente').val(response.data.name);
                            $('#nombre_paciente').removeClass('d-none');
                            $('#paciente_id').val(response.data.id);
                        }else{
                            $('#dni_paciente').removeClass('is-valid');
                            $('#dni_paciente').addClass('is-invalid');
                            $('#nombre_paciente').val('');
                            $('#nombre_paciente').addClass('d-none');
                            $('#paciente_id').val('');
                        }
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
            }else{
                $('#dni_paciente').removeClass('is-valid');
                $('#dni_paciente').removeClass('is-invalid');
                $('#nombre_paciente').text('');
            }
        });

        // $('#crearCita').on('click', function(){
        //     let paciente_id = $('#paciente_id').val();
        //     if(paciente_id){
        //         window.location.href = `{{route('citas.create')}}?paciente_id=${paciente_id}`;
        //     }
        // });
    });
</script>

@endsection
