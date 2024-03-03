@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex justify-content-start flex-column gap-3">
            @if(Auth::user()->rol == 'admin' )
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div>
                            <h3>Users</h3>
                            <hr>
                            <div class="d-flex justify-content-start gap-3 flex-column flex-md-row">
                                <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuarios</a>
                                <a href="{{ route('pacientes.index')}}" class="btn btn-primary"> Ver Pacientes</a>
                                <a href="{{ route('empleados.index')}}" class="btn btn-primary"> Ver Empleados</a>
                                <a href="{{ route('empleados.index')}}?rol=medico" class="btn btn-primary"> Ver Médicos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div>
                            <h3>Especialidades</h3>
                            <hr>
                            <div class="d-flex justify-content-start gap-3 flex-column flex-md-row">
                                <a href="{{ route('especialidades.create') }}" class="btn btn-primary">Crear Especialidad</a>
                                <a href="{{ route('especialidades.index') }}" class="btn btn-primary">Ver Especialidades</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(Auth::user()->rol != 'paciente')
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div>
                            <h3>Citas</h3>
                            <hr>
                            <div class="d-flex justify-content-start gap-3 flex-column flex-md-row">
                                {{-- <a id="crearCita" class="btn btn-primary"
                                data-bs-toggle="collapse" href="#form_cita" role="button"
                                aria-expanded="false" aria-controls="form_cita">Crear Cita</a> --}}
                                <a href="{{ route('citas.busqueda') }}" class="btn btn-primary">Crear cita</a>
                                <a href="{{ route('citas.index') }}" class="btn btn-primary">Ver citas</a>
                            </div>
                            {{-- <div class="collapse" id="form_cita">
                                <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="dni_paciente">Paciente</label>
                                        <input type="text" name="dni_paciente" id="dni_paciente" class="form-control">
                                        <input type="hidden" name="paciente_id" id="paciente_id" class="form-control">

                                    </div>
                                    <div class="col-md-6 d-flex flex-column justify-content-end">
                                        <input type="text" readonly id="nombre_paciente" class="form-control d-none">
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary mt-3" id="crearCita">Crear Cita</button>
                                    </div>
                                </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
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
