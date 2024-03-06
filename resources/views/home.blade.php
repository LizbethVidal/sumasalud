@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->rol == 'admin' )
            <div class="col-md-3 my-3 my-md-0">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-start gap-3 flex-column">
                                <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuarios</a>
                                <a href="{{ route('pacientes.index')}}" class="btn btn-primary"> Ver Pacientes</a>
                                <a href="{{ route('empleados.index')}}" class="btn btn-primary"> Ver Empleados</a>
                                <a href="{{ route('empleados.index')}}?rol=medico" class="btn btn-primary"> Ver Médicos</a>
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
                                <a href="{{ route('especialidades.create') }}" class="btn btn-primary">Crear Especialidad</a>
                                <a href="{{ route('especialidades.index') }}" class="btn btn-primary">Ver Especialidades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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

                    </div>
                    <div class="card-body">

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
